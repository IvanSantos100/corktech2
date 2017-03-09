<?php


use Illuminate\Database\Seeder;

class EstampasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\CorkTeck\Models\Estampa::class, 20)->create();
    }
}
