<?php

namespace TheProfessor\LaravelChatChannels\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use TheProfessor\LaravelChatChannels\LaravelChatChannelsServiceProvider;

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
            LaravelChatChannelsServiceProvider::class,
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

        /*
        include_once __DIR__.'/../database/migrations/create_Laravel_Chat_Channels_table.php.stub';
        (new \CreatePackageTable())->up();
        */
    }
}
