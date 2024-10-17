<?php

namespace goodsystem\testpackage\console\Commands;

use Illuminate\Console\Command as Console;

class TestPackageInstallCommand extends Console
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'testpackage:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install testpackage Package';

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
        $this->info('testpackage installed successfully');

        return;
    }
}
