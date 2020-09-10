<?php

namespace TheProfessor\Laravelchatchannels;

use Illuminate\Support\ServiceProvider;
use TheProfessor\Laravelchatchannels\Commands\LaravelchatchannelsCommand;

class LaravelchatchannelsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/laravelchatchannels.php' => config_path('laravelchatchannels.php'),
            ], 'config');

            $this->publishes([
                __DIR__ . '/../resources/views' => base_path('resources/views/vendor/laravelchatchannels'),
            ], 'views');

            $migrationFileName = 'create_laravelchatchannels_table.php';
            if (! $this->migrationFileExists($migrationFileName)) {
                $this->publishes([
                    __DIR__ . "/../database/migrations/{$migrationFileName}.stub" => database_path('migrations/' . date('Y_m_d_His', time()) . '_' . $migrationFileName),
                ], 'migrations');
            }

            $this->commands([
                LaravelchatchannelsCommand::class,
            ]);
        }

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'laravelchatchannels');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/laravelchatchannels.php', 'laravelchatchannels');
    }

    public static function migrationFileExists(string $migrationFileName): bool
    {
        $len = strlen($migrationFileName);
        foreach (glob(database_path("migrations/*.php")) as $filename) {
            if ((substr($filename, -$len) === $migrationFileName)) {
                return true;
            }
        }

        return false;
    }
}
