<?php
namespace App\Core\Tenancy;

use App\Models\Company;

class CurrentCompany
{
    public static function get(): ?Company
    {
        $id = session('current_company_id');
        return $id ? Company::find($id) : null;
    }

    public static function set(int $companyId): void
    {
        session(['current_company_id' => $companyId]);
    }

    public static function clear(): void
    {
        session()->forget('current_company_id');
    }
}
