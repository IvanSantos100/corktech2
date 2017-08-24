<?php

namespace CorkTech\Listeners;

use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  QueryExecuted  $event
     * @return void
     */
    public function handle(QueryExecuted $event)
    {

        /*
         * Extrai todas as propriedades do objeto QueryExecuted
         * $sql, $bindings, $connectionName e $time
         */
        extract(get_object_vars($event));

        /*
         * Associa os valores contidos no array $bindings
         * a query, substituindo os ?, ?, ?
         */
        $fullQuery = vsprintf(str_replace(array('%', '?'), array('%%', '%s'), $sql), $bindings);

        /*
         * Adiciona a query bem como connection name e tempo
         * de exeução ao arquivo /storage/log/laravel.log
         *
         * tail -f storage/logs/laravel.log
         * tail -f storage/app/logs/queries.log

         *
         */
        \Log::info("${connectionName} | ${time}ms | ${fullQuery}" . PHP_EOL);

    }
}
