<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(\App\Repositories\ProductRepository::class, \App\Repositories\ProductRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\CustomerRepository::class, \App\Repositories\CustomerRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\OrderRepository::class, \App\Repositories\OrderRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ProductOrderRepository::class, \App\Repositories\ProductOrderRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\OrderProductRepository::class, \App\Repositories\OrderProductRepositoryEloquent::class);
        //:end-bindings:
    }
}
