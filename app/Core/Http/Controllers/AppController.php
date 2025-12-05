<?php
namespace App\Core\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Core\Tenancy\CurrentCompany;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function index(Request $request)
    {
        $company = CurrentCompany::get();

        $modules = $company->modules()
            ->wherePivotIn('status', ['trialing','active'])
            ->get();

        return view('core.apps.index', compact('company','modules'));
    }
}
