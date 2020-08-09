<?php

namespace App\Console\Commands;

use App\Http\Controllers\PageController;
use Illuminate\Console\Command;

class updateSEO extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seo:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update sitemap and robots';

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
        $controller = new PageController(); 
        $controller->sitemap();
        return;
    }
}
