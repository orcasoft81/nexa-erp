<?php

namespace App\Http\Controllers\Auth;

use App\Core\Modules\ModuleAccessService;
use App\Core\Tenancy\CurrentCompany;
use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(Module $module): View
    {
        return view('auth.register', compact('module'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request, Module $module,ModuleAccessService $access): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);



        $company = CurrentCompany::get();
        if ($company) {
            $company->modules()->syncWithoutDetaching([
                $module->id => [
                    'status' => 'trialing',
                    'start_date' => now()->toDateString(),
                ]
            ]);

            $access->grantUserAccess($user, $company, $module);
        }

        return redirect()->route('modules.show', $module->code)
            ->with('success', "Welcome! {$module->name} activated.");
    }
}
