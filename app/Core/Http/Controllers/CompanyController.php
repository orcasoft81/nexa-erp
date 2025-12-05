<?php
namespace App\Core\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Core\Tenancy\CurrentCompany;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function select(Request $request)
    {
        $companies = $request->user()->companies()->get();
        return view('core.companies.select', compact('companies'));
    }

    public function setCurrent(Request $request)
    {
        $request->validate(['company_id' => 'required|exists:companies,id']);

        $companyId = (int) $request->company_id;

        abort_unless(
            $request->user()->companies()->where('companies.id', $companyId)->exists(),
            403
        );

        CurrentCompany::set($companyId);

        return redirect()->route('apps.index');
    }
}
