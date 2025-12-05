<?php
namespace App\Core\Http\Middleware;

use Closure;
use App\Core\Tenancy\CurrentCompany;
use App\Core\Modules\ModuleAccessService;
use App\Models\Module;

class EnsureModuleSubscribed
{
    public function __construct(private ModuleAccessService $access) {}

    public function handle($request, Closure $next, string $moduleCode)
    {
        $company = CurrentCompany::get();
        $module = Module::where('code', $moduleCode)->firstOrFail();

        if (!$this->access->companyHasModule($company, $module)) {
            return redirect()->route('modules.show', $moduleCode)
                ->with('error', 'This module is not subscribed for your company.');
        }

        if (!$this->access->userHasModule($request->user(), $company, $module)) {
            abort(403, 'You do not have access to this module.');
        }

        return $next($request);
    }
}
