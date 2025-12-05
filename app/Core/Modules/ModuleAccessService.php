<?php
namespace App\Core\Modules;

use App\Models\Module;
use App\Models\User;
use App\Models\Company;

class ModuleAccessService
{
    public function companyHasModule(Company $company, Module $module): bool
    {
        return $company->modules()
            ->where('modules.id', $module->id)
            ->wherePivotIn('status', ['trialing','active'])
            ->exists();
    }

    public function userHasModule(User $user, Company $company, Module $module): bool
    {
        return $user->modules()
            ->where('modules.id', $module->id)
            ->wherePivot('company_id', $company->id)
            ->wherePivot('status', 'active')
            ->exists();
    }

    public function grantUserAccess(User $user, Company $company, Module $module): void
    {
        $user->modules()->syncWithoutDetaching([
            $module->id => [
                'company_id' => $company->id,
                'status' => 'active',
                'subscribed_at' => now(),
            ]
        ]);
    }
}
