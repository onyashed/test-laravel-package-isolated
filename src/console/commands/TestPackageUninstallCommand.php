<?php

namespace goodsystem\testpackage\console\Commands;

use Illuminate\Console\Command as Console;

class TestPackageUninstallCommand extends Console
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'testpackage:remove';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove testpackage Package';

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
        $this->info('testpackage removed successfully');

        return;
    }
}
