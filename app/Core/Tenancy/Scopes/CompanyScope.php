<?php
namespace App\Core\Tenancy\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use App\Core\Tenancy\CurrentCompany;


class CompanyScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        if ($company = CurrentCompany::get()) {
            if (schema()->hasColumn($model->getTable(), 'company_id')) {
                $builder->where($model->getTable().'.company_id', $company->id);
            }
        }
    }
}
