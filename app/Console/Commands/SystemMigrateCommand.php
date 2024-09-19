<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class SystemMigrateCommand extends Command
{

    // protected $signature = 'app:system-migrate-command';
    protected $signature = 'system:migrate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('------------------------------------');
        $this->info('Starting migrating Asfalto SYSTEM');
        Artisan::call('migrate --path=database/migrations/system/ --database=asfalto');
        $this->info(Artisan::output());
        $this->info('------------------------------------');
        $this->info('');
    }
}
