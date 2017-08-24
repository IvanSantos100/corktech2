<?php

use CorkTech\Models\Estoque;
use Illuminate\Database\Seeder;

class EstoquesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Estoque::class, 100)->create();
    }
}
