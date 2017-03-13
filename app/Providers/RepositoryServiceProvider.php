<?php

namespace CorkTeck\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\CorkTeck\Repositories\ProdutosRepository::class, \CorkTeck\Repositories\ProdutosRepositoryEloquent::class);
        $this->app->bind(\CorkTeck\Repositories\ClassesRepository::class, \CorkTeck\Repositories\ClassesRepositoryEloquent::class);
        $this->app->bind(\CorkTeck\Repositories\EstampasRepository::class, \CorkTeck\Repositories\EstampasRepositoryEloquent::class);
        $this->app->bind(\CorkTeck\Repositories\TipoProdutosRepository::class, \CorkTeck\Repositories\TipoProdutosRepositoryEloquent::class);
        $this->app->bind(\CorkTeck\Repositories\CentroDistribuicoesRepository::class, \CorkTeck\Repositories\CentroDistribuicoesRepositoryEloquent::class);
        //:end-bindings:
    }
}
