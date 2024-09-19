<?php

namespace Database\Seeders\Asfalto;

use App\Models\Tenant;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tenants = [
            ['name' => 'tenant1', 'domain' => 'tenant1.asfalto.test', 'database' => 'tenant1'],
            ['name' => 'tenant2', 'domain' => 'tenant2.asfalto.test', 'database' => 'tenant2'],
            ['name' => 'tenant3', 'domain' => 'tenant3.asfalto.test', 'database' => 'tenant3'],
        ];

        Tenant::insert($tenants);


    }
}
