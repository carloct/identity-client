<?php

namespace JS\Services\Products;

use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client;

class ProductsServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    public function boot()
    {
        $this->publishes([__DIR__.'/config/products.php' => config_path('products.php')]);
    }

    public function register()
    {
        config(['config/products.php']);

        $this->app->bind(
            'JS\\Services\\Products\\ProductsClientInterface',
            'JS\\Services\\Products\\ProductsClient'
        );

        $this->app
            ->when('JS\Services\Products\ProductsClient')
            ->needs('JS\Services\Products\Contracts\FactoryInterface')
            ->give(function () {
                return new ProductsClientFactory(
                    new Client(), config('products.API_PRODUCTS'), []);
            });
    }
}