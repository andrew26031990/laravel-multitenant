<?php

namespace App\Http\Middleware;
use App\Exceptions\CompanyNotFoundException;
use App\Exceptions\UserNotBelongsToCompanyException;
use App\Models\Tenant;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//use mysql_xdevapi\Exception;
use App\Http\Middleware\InitializeTenancyByDomain;
use App\Http\Middleware\PreventAccessFromCentralDomains;

class CheckUserTenantMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $host = explode('.', $_SERVER['HTTP_HOST'])[0];
        if($host == 'api'){
            $host = explode('.', $_SERVER['HTTP_HOST'])[1];
        }

        $tenant = Tenant::whereSlug($host)->first();
        if(!$tenant){
            throw new CompanyNotFoundException(__('Company not found'));
        }

        tenancy()->initialize($tenant);

        if(!$tenant->users->contains('id', auth()->user()->getAuthIdentifier())){
            throw new UserNotBelongsToCompanyException(__('Access denied'));
        }

        return $next($request);
    }
}
