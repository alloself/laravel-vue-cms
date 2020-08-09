<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class InitApp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migration and secrets';

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
        $this->call('key:generate');
        $this->call('migrate:fresh', [
            '--seed' => true
        ]);
        $this->call('passport:install', [
            '--force' => true
        ]);
        if (file_exists(public_path('public'))) {
            return $this->error('The "public/public" directory already exists.');
        }

        $this->laravel->make('files')->link(
            storage_path('app/public'),
            public_path('public')
        );

        $this->info('The [public/public] directory has been linked.');
        $this->call('route:clear');
        return;
    }
}
