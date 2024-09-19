<?php

namespace App\Console\Commands\Tenants;

use App\Models\Tenant;
use App\Service\TenantServcie;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class MigrateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tenants:migrate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tenants Migration';

    private $tenant;
    public function __construct(TenantServcie $tenant)
    {
        parent::__construct();
        $this->tenant =  $tenant;
        // dd($tenant);
    }
    public function handle()
    {
        $tenants = Tenant::all();

        $tenants->each(function ($tenant) {

            TenantServcie::switchToTenant($tenant);
            $this->info('------------------------------------');
            $this->info('Starting migrating : ' . $tenant->domain);
            Artisan::call('migrate --path=database/migrations/tenants/ --database=tenant');
            $this->info(Artisan::output());
            $this->info('Ending migrating : ' . $tenant->domain);
            $this->info('------------------------------------');
            $this->info('');

        });

        return Command::SUCCESS;
    }
}
