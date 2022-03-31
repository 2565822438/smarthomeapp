<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Subscribe extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'start:s';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'start subscribe';
    
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
        return 0;
    }
}
