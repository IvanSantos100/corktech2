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
        'tamanho' => rand(1,50).' X '.rand(1,50),
        'espessura' => rand(1,100),
        'atacado' => rand(1,50),
        'varejo'=> rand(1,50),
        'granel'=> rand(1,50),
    ];
});
