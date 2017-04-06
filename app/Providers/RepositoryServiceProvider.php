<?php

namespace CorkTech\Providers;

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
        $this->app->bind(\CorkTech\Repositories\ProdutosRepository::class, \CorkTech\Repositories\ProdutosRepositoryEloquent::class);
        $this->app->bind(\CorkTech\Repositories\ClassesRepository::class, \CorkTech\Repositories\ClassesRepositoryEloquent::class);
        $this->app->bind(\CorkTech\Repositories\EstampasRepository::class, \CorkTech\Repositories\EstampasRepositoryEloquent::class);
        $this->app->bind(\CorkTech\Repositories\TipoProdutosRepository::class, \CorkTech\Repositories\TipoProdutosRepositoryEloquent::class);
        $this->app->bind(\CorkTech\Repositories\CentroDistribuicoesRepository::class, \CorkTech\Repositories\CentroDistribuicoesRepositoryEloquent::class);
        $this->app->bind(\CorkTech\Repositories\EstoquesRepository::class, \CorkTech\Repositories\EstoquesRepositoryEloquent::class);
        $this->app->bind(\CorkTech\Repositories\ClientesRepository::class, \CorkTech\Repositories\ClientesRepositoryEloquent::class);
        $this->app->bind(\CorkTech\Repositories\PedidosRepository::class, \CorkTech\Repositories\PedidosRepositoryEloquent::class);
        $this->app->bind(\CorkTech\Repositories\ItensPedidosRepository::class, \CorkTech\Repositories\ItensPedidosRepositoryEloquent::class);
        $this->app->bind(\CorkTech\Repositories\UsuariosRepository::class, \CorkTech\Repositories\UsuariosRepositoryEloquent::class);
        //:end-bindings:
    }
}
