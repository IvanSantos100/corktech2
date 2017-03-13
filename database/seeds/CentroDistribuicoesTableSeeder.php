<?php

use CorkTeck\Models\CentroDistribuicao;
use Illuminate\Database\Seeder;

class CentroDistribuicoesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {    // 1 => nacional, 2 => distribuidora, 3 => revenda
        factory(CentroDistribuicao::class, 1)->create([
            'descricao' => 'nacional',
            'tipo' => 'Nacional',
            'prazo_fabrica' => 30,
            'prazo_nacional' => 15,
            'prazo_regional' => 2,
            'valor_base' => 500,
        ]);
        factory(CentroDistribuicao::class, 1)->create([
            'descricao' => 'distribuidora',
            'tipo' => 'Distribuidora',
            'prazo_fabrica' => 30,
            'prazo_nacional' => 15,
            'prazo_regional' => 2,
            'valor_base' => 500,
        ]);
        factory(CentroDistribuicao::class, 1)->create([
            'descricao' => 'revenda',
            'tipo' => 'Revenda',
            'prazo_fabrica' => 30,
            'prazo_nacional' => 15,
            'prazo_regional' => 2,
            'valor_base' => 500,
        ]);
    }
}
