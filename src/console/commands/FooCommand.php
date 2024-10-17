<?php

namespace GoodSystem\TestPackage\Console\Commands;

use Illuminate\Console\Command as Console;

class FooCommand extends Console
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'foopackage:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install subpackage Package';

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
     * @return mixed
     */
    public function handle()
    {
        $this->info('foopackage installed successfully');

        return;
    }
}
