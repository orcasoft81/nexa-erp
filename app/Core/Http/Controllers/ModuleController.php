<?php
namespace App\Core\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Core\Tenancy\CurrentCompany;
use App\Core\Modules\ModuleAccessService;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function index()
    {
        $modules = Module::where('status', 'active')->get();
        return view('core.modules.index', compact('modules'));
    }

    public function show(Module $module)
    {
        $app = [
        'title'   => $module->name,
        'tagline' => $module->description ?? '',
        'color'   => $module->color ?? 'purple',

        // If features is stored as JSON in DB:
        'features' => is_array($module->features)
            ? $module->features
            : (json_decode($module->features ?? '[]', true) ?: []),
    ];

    return view('core.modules.show', compact('module', 'app'));
    }

    public function subscribe(Request $request, Module $module, ModuleAccessService $access)
    {
        $company = CurrentCompany::get();

        $company->modules()->syncWithoutDetaching([
            $module->id => [
                'status' => 'trialing',
                'start_date' => now()->toDateString(),
            ]
        ]);

        // grant access to subscribing user immediately
        $access->grantUserAccess($request->user(), $company, $module);

        return redirect()->route('apps.index')
            ->with('success', 'Module subscribed!');
    }
}
