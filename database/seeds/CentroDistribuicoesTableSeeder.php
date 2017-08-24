<?php

use CorkTech\Models\CentroDistribuicao;
use Illuminate\Database\Seeder;

class CentroDistribuicoesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(CentroDistribuicao::class, 1)->create([
            'descricao' => 'Nacional',
            'tipo' => 1,
            'prazo_fabrica' => 30,
            'prazo_nacional' => 15,
            'prazo_regional' => 2,
            'valor_base' => 500,
        ]);
        factory(CentroDistribuicao::class, 1)->create([
            'descricao' => 'Distribuidora',
            'tipo' => 2,
            'prazo_fabrica' => 30,
            'prazo_nacional' => 15,
            'prazo_regional' => 2,
            'valor_base' => 500,
        ]);
        factory(CentroDistribuicao::class, 1)->create([
            'descricao' => 'Revenda',
            'tipo' => 3,
            'prazo_fabrica' => 30,
            'prazo_nacional' => 15,
            'prazo_regional' => 2,
            'valor_base' => 500,
        ]);
    }
}
