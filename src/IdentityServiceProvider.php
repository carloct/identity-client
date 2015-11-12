<?php

namespace JS\Services\Identity;

use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client;

class IdentityServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    public function boot()
    {
        $this->publishes([__DIR__.'/config/identity.php' => config_path('identity.php')]);
    }

    public function register()
    {
        config(['config/identity.php']);

        $this->app->bind(
            'JS\\Services\\Identity\\IdentityClientInterface',
            'JS\\Services\\Identity\\IdentityClient'
        );

        $this->app
            ->when('JS\Services\Identity\IdentityClient')
            ->needs('JS\Services\Identity\Contracts\FactoryInterface')
            ->give(function () {
                return new IdentityClientFactory(
                    new Client(), 
                    config('identity.IDENTITY_AUTH'), 
                    [ config('identity_client.IDENTITY_CLIENT_ID'), config('identity_client.IDENTITY_CLIENT_PW')]
                );
            });
    }
}