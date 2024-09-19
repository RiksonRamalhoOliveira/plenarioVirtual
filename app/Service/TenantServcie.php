<?php

namespace App\Service;

use App\Models\Tenant;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;

class TenantServcie
{
    private static $tenant;
    private static $domain;
    private static $database;
    public static function switchToTenant(Tenant $tenant)
    {

        if (!$tenant instanceof Tenant) {
            throw ValidationException::withMessages(['field_name' => 'This value is incorrect']);
        }
        DB::purge('asfalto');
        DB::purge('tenant');
        Config::set('database.connections.tenant.database', $tenant->database);

        Self::$tenant = $tenant;
        Self::$domain = $tenant->domain;
        Self::$database = $tenant->database;
        $databaseName = $tenant->database;

        DB::connection('tenant');
        // Schema::connection('tenant')->getConnection()->reconnect();
        DB::setDefaultConnection('tenant');


    }

    public static function switchToDefault()
    {
        DB::purge('asfalto');
        DB::purge('tenant');
        DB::connection('asfalto')->connect();

        DB::setDefaultConnection('asfalto');
    }

    public static function getTenant()
    {
        return Self::$tenant;
    }
}
