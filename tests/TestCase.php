<?php

namespace TheProfessor\Laravelrooms\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use TheProfessor\Laravelrooms\AuthServiceProvider;
use TheProfessor\Laravelrooms\LaravelroomsServiceProvider;

class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();

        $this->withFactories(__DIR__.'/database/factories');
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelroomsServiceProvider::class,
            AuthServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);


        include_once __DIR__ . '/../database/migrations/create_laravelrooms_table.php.stub';
        (new \CreateLaravelroomsTable())->up();

        include_once __DIR__ . '/../database/migrations/create_users_table.php.stub';
        (new \CreateUsersTable())->up();
    }
}
