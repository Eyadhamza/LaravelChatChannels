<?php

namespace TheProfessor\LaravelChatChannels;

use Illuminate\Support\ServiceProvider;
use TheProfessor\LaravelChatChannels\Commands\LaravelChatChannelsCommand;

class LaravelChatChannelsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/Laravel-Chat-Channels.php' => config_path('Laravel-Chat-Channels.php'),
            ], 'config');

            $this->publishes([
                __DIR__ . '/../resources/views' => base_path('resources/views/vendor/Laravel-Chat-Channels'),
            ], 'views');

            $migrationFileName = 'create_Laravel_Chat_Channels_table.php';
            if (! $this->migrationFileExists($migrationFileName)) {
                $this->publishes([
                    __DIR__ . "/../database/migrations/{$migrationFileName}.stub" => database_path('migrations/' . date('Y_m_d_His', time()) . '_' . $migrationFileName),
                ], 'migrations');
            }

            $this->commands([
                LaravelChatChannelsCommand::class,
            ]);
        }

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'Laravel-Chat-Channels');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/Laravel-Chat-Channels.php', 'Laravel-Chat-Channels');
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
