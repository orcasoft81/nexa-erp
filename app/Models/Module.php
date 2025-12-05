<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
     protected $fillable = ['code','name','description','version','status'];

    public function companies() {
        return $this->belongsToMany(Company::class, 'company_module')
            ->withPivot(['status','plan_id']);
    }
}
