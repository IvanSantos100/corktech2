<?php


use Illuminate\Database\Seeder;

class TipoProdutosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\CorkTeck\Models\TipoProduto::class, 20)->create();
    }
}
