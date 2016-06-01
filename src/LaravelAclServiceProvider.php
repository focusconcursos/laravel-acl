<?php

namespace Mahesvaran\LaravelAcl;

use Illuminate\Support\ServiceProvider;

class LaravelAclServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishConfig();
        $this->publishMigration();
        $this->publishViews();
        if (! $this->app->routesAreCached()) {
            require __DIR__.'/routes.php';
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands(
            'Mahesvaran\LaravelAcl\Commands\AclCommand',
            'Mahesvaran\LaravelAcl\Commands\AclSyncCommand'
        );
    }

    /**
     * Publish the migration to the application migration folder
     */
    public function publishMigration()
    {
        $this->publishes([
            __DIR__ . '/../database/migrations/' => base_path('/database/migrations'),
        ], 'migrations');

        $this->publishes([
            __DIR__ . '/../database/seeds/' => base_path('/database/seeds'),
        ], 'seeds');
    }
    /**
     * Publish the views to the application views folder
     */
    public function publishViews()
    {
        $this->publishes([
            __DIR__ . '/../resources/views/' => base_path('/resources/views'),
        ], 'views');
    }

    public function publishConfig()
    {
        $this->publishes([
            __DIR__.'/../config/role.php' => config_path('role.php')
        ], 'config');
    }
}
