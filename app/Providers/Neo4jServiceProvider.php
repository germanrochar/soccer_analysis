<?php

namespace App\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Laudis\Neo4j\ClientBuilder;
use Laudis\Neo4j\Contracts\ClientInterface;


class Neo4jServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ClientInterface::class, function ($app) {
            $host = Config::get('database.connections.neo4j.host');
            $protocol = Config::get('database.connections.neo4j.protocol');
            $username = Config::get('database.connections.neo4j.username');
            $password = Config::get('database.connections.neo4j.password');

            return ClientBuilder::create()
                ->withDriver('default', "$protocol://$username:$password@$host")
                ->build();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
