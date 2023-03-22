<?php

namespace DevRaeph\ALH;

use DevRaeph\ALH\Commands\ALHClearOldLogs;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class ALHServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('alh')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel-alh_table')
            ->hasCommand(ALHClearOldLogs::class)
            ->publishesServiceProvider('ALHMainServiceProvider')
            ->hasInstallCommand(function (InstallCommand $command) {
                $command
                    ->publishConfigFile()
                    ->publishAssets()
                    ->publishMigrations()
                    ->askToRunMigrations()
                    ->copyAndRegisterServiceProviderInApp()
                    ->askToStarRepoOnGitHub('devraeph/laravel-alh');
            });
    }
}
