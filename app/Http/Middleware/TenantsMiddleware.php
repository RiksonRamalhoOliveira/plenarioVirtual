<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use App\Models\Tenant;
use App\Service\TenantServcie;

class TenantsMiddleware
{

    public function handle(Request $request, Closure $next): Response
    {
        $host = $request->getHost();
        $tenant = Tenant::where('domain','=',$host)->firstOrFail();
        // dd($host);
        // dd($tenant->domain);
        // TenantServcie::switchToTenant($tenant);
        // return $next($request);

        DB::purge('system');
        // DB::purge('system');
        Config::set('database.connections.tenant.database',$tenant->database);
        DB::connection('tenant')->reconnect();
        DB::setDefaultConnection('tenant');
        // dd($host);

        return $next($request);
    }
}
