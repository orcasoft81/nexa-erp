<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name','legal_name','tax_number','owner_user_id','parent_company_id','logo_url',
        'address','phone','email','website','industry','city','state','country','postal_code','status'
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_user_id');
    }

    public function users(){
        return $this->belongsToMany(User::class)->with(['role','joined_at','invited_by'])
                    ->withTimestamps();
    }

   public function modules() {
        return $this->belongsToMany(Module::class, 'company_module')
            ->withPivot(['status','plan_id','start_date','end_date'])
            ->withTimestamps();
    }

    public function parent() {
        return $this->belongsTo(Company::class, 'parent_company_id');
    }

    public function children() {
        return $this->hasMany(Company::class, 'parent_company_id');
    }
}
