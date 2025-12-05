<?php

namespace App\Core\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Company;
use App\Models\Module;
use App\Core\Modules\ModuleAccessService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /**
     * Show registration form for a specific module.
     */
    public function create(Module $module)
    {
        return view('auth.register', compact('module'));
    }

    /**
     * Handle registration for a specific module.
     * Creates: user + company + pivots + module subscription.
     */
    public function store(
        Request $request,
        Module $module,
        ModuleAccessService $access
    ) {
        $data = $request->validate([
            'name' => ['required','string','max:255'],
            'email' => ['required','email','max:255','unique:users,email'],
            'password' => ['required','confirmed','min:8'],

            // company fields
            'company_name' => ['required','string','max:255'],
            'country' => ['nullable','string','max:100'],
            'city' => ['nullable','string','max:100'],
            'address' => ['nullable','string','max:255'],
        ]);

        return DB::transaction(function () use ($data, $module, $access) {

            // 1) Create User
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'status' => 'active',
            ]);

            // 2) Create Company (owned by that user)
            $company = Company::create([
                'name' => $data['company_name'],
                'owner_user_id' => $user->id,
                'country' => $data['country'] ?? null,
                'city' => $data['city'] ?? null,
                'address' => $data['address'] ?? null,
                'status' => 'active',
            ]);

            // 3) Attach user to company as owner
            $company->users()->attach($user->id, [
                'role' => 'owner',
                'joined_at' => now(),
            ]);

            // 4) Subscribe company to the chosen module (trial by default)
            $company->modules()->syncWithoutDetaching([
                $module->id => [
                    'status' => 'trialing',
                    'start_date' => now()->toDateString(),
                ]
            ]);

            // 5) Grant this user access to that module under that company
            $access->grantUserAccess($user, $company, $module);

            // 6) Fire registered event + login
            event(new Registered($user));
            Auth::login($user);

            // 7) Set current company in session
            session(['current_company_id' => $company->id]);

            return redirect()->route('apps.index');
        });
    }
}
