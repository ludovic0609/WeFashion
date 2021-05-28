<?php

use Faker\Generator as Faker;
use App\Product;
use Illuminate\Support\Str;

$factory->define(App\Product::class, function (Faker $faker) {

    

    
    return [
        'name' => $faker->sentence(),
        'description' => $faker->paragraph(),
        'price' => $faker->randomFloat(2, 1, 300),
        'product_visible' => rand(0, 1),
        'state_product' => rand(0, 1),
        'reference' => Str::random(16)
        
    ];
});
