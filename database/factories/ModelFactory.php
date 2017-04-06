<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(CorkTech\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'centrodistribuicao_id' => 1,
        'password' => $password ?: $password = bcrypt('secret'),
        'endereco' =>$faker->address,
        'bairro' => 'teste',
        'cidade' => $faker->city,
        'UF' => $faker->name,
        'CEP' =>rand(111111,9999999),
        'fone' => 123456,
        'celular' => 123456,
        'remember_token' => str_random(10),
        'is_permission' => 1,
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(CorkTech\Models\Classe::class, function (Faker\Generator $faker) {

    return [
        'descricao' => $faker->sentence(2),
        'tamanho' => rand(1,50).' X '.rand(1,50),
        'espessura' => rand(1,100),
        'atacado' => rand(1,50),
        'varejo'=> rand(1,50),
        'granel'=> rand(1,50),
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(CorkTech\Models\Estampa::class, function (Faker\Generator $faker) {

    return [
        'descricao' => $faker->sentence(2),
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(CorkTech\Models\TipoProduto::class, function (Faker\Generator $faker) {

    return [
        'descricao' => $faker->sentence(2),
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(CorkTech\Models\Produto::class, function (Faker\Generator $faker) {

    return [
        'descricao' => $faker->sentence(2),
        'preco' => $faker->randomFloat(2,10,100),
        'estampa_id' => rand(1,20),
        'classe_id' => rand(1,20),
        'tipoproduto_id' => rand(1,20),
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(CorkTech\Models\CentroDistribuicao::class, function (Faker\Generator $faker) {

    return [
        'descricao' => 'Nacional',
        'tipo' => 1,
        'prazo_fabrica' => 30,
        'prazo_nacional' => 15,
        'prazo_regional' => 2,
        'valor_base' => 500,
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(CorkTech\Models\Estoque::class, function (Faker\Generator $faker) {

    return [
        'lote' => rand(111111111, 999999999),
        'valor' => $faker->randomFloat(2,10,100),
        'centrodistribuicao_id' => rand(1,3),
        'produto_id' => rand(1,100),
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(CorkTech\Models\Cliente::class, function (Faker\Generator $faker) {

    return [
        'tipo' => rand(1,2),
        'nome' => $faker->name,
        'documento' => rand(1111, 9999),
        'endereco' =>$faker->address,
        'bairro' => 'teste',
        'cidade' => $faker->city,
        'UF' => $faker->name,
        'CEP' =>rand(111111,9999999),
        'senha' => bcrypt('secret'),
        'responsavel' => $faker->name,
        'fone' => 123456,
        'celular' => 123456,
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(CorkTech\Models\Pedido::class, function (Faker\Generator $faker) {

    return [
        'tipo' => rand(1,3),
        'status' => rand(1,2),
        'valor_base' => $faker->randomFloat(2,10,100),
        'desconto' => $faker->randomFloat(2,10,100),
        'forma_pagamento' => rand(1,2),
        'date_confirmacao' => $faker->date('Y-m_d'),
        'obs' => $faker->sentence(),
        'origem_id' => rand(1,3),
        'destino_id' => rand(1,3),
        'cliente_id' => rand(1,20),
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(CorkTech\Models\ItemPedido::class, function (Faker\Generator $faker) {

    return [
        'pedido_id' => rand(1,100),
        'produto_id' => rand(1,100),
        'quantidade' => rand(1,100),
        'preco' => $faker->randomFloat(2,10,100),
        'prazoentrega' => $faker->date('Y-m_d'),
    ];
});
