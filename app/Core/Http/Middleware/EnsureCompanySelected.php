<?php
namespace App\Core\Http\Middleware;

use Closure;
use App\Core\Tenancy\CurrentCompany;

class EnsureCompanySelected
{
    public function handle($request, Closure $next)
    {
        if (!CurrentCompany::get()) {
            return redirect()->route('companies.select');
        }
        return $next($request);
    }
}
