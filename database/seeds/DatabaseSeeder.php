<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->call(ClassesTableSeeder::class);
        $this->call(EstampasTableSeeder::class);
        $this->call(TipoProdutosTableSeeder::class);
        $this->call(ProdutosTableSeeder::class);
        $this->call(CentroDistribuicoesTableSeeder::class);
        //$this->call(EstoquesTableSeeder::class);
        $this->call(ClientesTableSeeder::class);
        //$this->call(PedidosTableSeeder::class);
        //$this->call(itempedidosTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
