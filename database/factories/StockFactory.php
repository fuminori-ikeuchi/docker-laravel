<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Stock;
use Faker\Generator as Faker;

$factory->define(App\Models\Stock::class, function (Faker $faker) {
    
    return [
        'name' => $faker->randomElement($name),
        'num' => '0',
        'price' => '10000',
    ];
});
