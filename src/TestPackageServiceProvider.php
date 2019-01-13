<?php
// test-laravel-package-isolated/src/TestPackageServiceProvider.php
namespace GoodSystem\TestPackage;

use Illuminate\Support\ServiceProvider;

class TestPackageServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/Test.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'test');
    }
    // ....
}

