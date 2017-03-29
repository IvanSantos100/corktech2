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
$factory->define(CorkTeck\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(CorkTeck\Models\Classe::class, function (Faker\Generator $faker) {

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
$factory->define(CorkTeck\Models\Estampa::class, function (Faker\Generator $faker) {

    return [
        'descricao' => $faker->sentence(2),
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(CorkTeck\Models\TipoProduto::class, function (Faker\Generator $faker) {

    return [
        'descricao' => $faker->sentence(2),
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(CorkTeck\Models\Produto::class, function (Faker\Generator $faker) {

    return [
        'descricao' => $faker->sentence(2),
        'preco' => $faker->randomFloat(2,10,100),
        'estampa_id' => rand(1,20),
        'classe_id' => rand(1,20),
        'tipoproduto_id' => rand(1,20),
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(CorkTeck\Models\CentroDistribuicao::class, function (Faker\Generator $faker) {

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
$factory->define(CorkTeck\Models\Estoque::class, function (Faker\Generator $faker) {

    return [
        'lote' => rand(111111111, 999999999),
        'valor' => $faker->randomFloat(2,10,100),
        'centrodistribuicao_id' => rand(1,3),
        'produto_id' => rand(1,100),
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(CorkTeck\Models\Cliente::class, function (Faker\Generator $faker) {

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
