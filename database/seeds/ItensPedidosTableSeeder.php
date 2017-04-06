<?php


use Illuminate\Database\Seeder;

class ItensPedidosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\CorkTech\Models\ItemPedido::class, 100)->create();
    }
}
