<?php
// test-laravel-package-isolated/src/TestPackageServiceProvider.php
namespace GoodSystem\TestPackage;

use Illuminate\Support\ServiceProvider;

class TestPackageServiceProvider extends ServiceProvider
{
    public function boot(\Illuminate\Routing\Router $router)
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/Test.php');
        $this->loadRoutesFrom(__DIR__.'/../routes/MpesaRoutes.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'test');
        //commands
        $this->commands([
            \GoodSystem\TestPackage\console\Commands\FooCommand ::class,
            \GoodSystem\TestPackage\console\Commands\TestPackageInstallCommand::class,
            \GoodSystem\TestPackage\console\Commands\TestPackageUninstallCommand::class
        ]);
    }
  /*  public function configurePackage(Package $package): void
    {
        $package
            ->name('your-package')
            ->hasConfigFile()
            ->hasTranslations()
            ->hasCommands([
                BackupCommand::class,
                CleanupCommand::class,
                ListCommand::class,
                MonitorCommand::class,
            ])
            */
    // .
     /**
     * Register the package's commands.
     */
    public function loadCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                TestPackageInstallCommand::class,
            ]);
        }
    }
}

