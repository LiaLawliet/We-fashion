<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) { // On créé des données d'exemple 
    return [
        'name' => $faker->sentence($nbWords = 2, $variableNbWords = true),
        'description' => $faker->paragraph(),
        'reference' => $faker->regexify('[A-Z0-9]{16}'),
        'price' => $faker->numberBetween($min = 100, $max = 400)
    ];
});
