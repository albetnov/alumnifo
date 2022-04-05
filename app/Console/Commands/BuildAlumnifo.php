<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class BuildAlumnifo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'build:alumnifo {--rebuild} {--no-dummy}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'A simple command to build entire alumnifo ecosystem';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $rebuild = $this->option('rebuild');
        $noDummy = $this->option('no-dummy');
        $this->info('Alumnifo by <bg=blue;fg=white>Albet Novendo</>, <bg=red;fg=white>Sendy Wahyudi</>, <bg=yellow;fg=white>Irwanda Andika</>');
        $this->info('Building Alumnifo...');

        if (!$rebuild) {
            $this->info('Detecting .env file');
            if (!file_exists(__DIR__.'/../../../.env')) {
                $this->info('.env file is not detected in base directory.');
                $this->info('Please configure your .env. We will generate .env file for you.');
                $this->info('After .env configured, run this command again.');
                $this->info('Dont forget to fill pusher cresidentials to unlock chatting features');
                copy('.env.example', '.env');
                Artisan::call('key:generate');
                exit();
            }
        }

        $this->info('Migrating databases...');
        if (!$noDummy) {
            Artisan::call('migrate:fresh --seed');
        } else {
            Artisan::call('migrate:fresh');
            Artisan::call('db:seed --class=Database\\Seeders\\PermissionSeeder');
            Artisan::call('db:seed --class=Database\\Seeders\\RoleSeeder');
            Artisan::call('db:seed --class=Database\\Seeders\\TeamsSeeder');
            Artisan::call('db:seed --class=Database\\Seeders\\UserSeeder');
        }
        $this->info('Migrating completed.');

        if (!$rebuild) {
            $this->info('Copying necessary resources...');
            $this->info("Attempting to storage link...");
            Artisan::call('storage:link');
            $this->info("Copying resources...");
            $directory = __DIR__.'/../../../public/files/teams';
            $files = array_diff(scandir($directory), ['.', '..']);
            $todir = __DIR__.'/../../../public/storage/teams';
            mkdir($todir);
            foreach ($files as $file) {
                copy($directory."/{$file}", $todir."/{$file}");
            }
            $this->info('Copied successfully.');
            $this->info("Alumnifo Build has successfully runned.");
        } else {
            $this->info("Rebuilding Alumnifo completed successfully.");
        }

        return 0;
    }
}
