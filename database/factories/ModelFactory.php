<?php

$factory->define(CodeCommerce\User::class, function ($faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => str_random(10),
        'remember_token' => str_random(10),
    ];
});

$factory->define(CodeCommerce\Category::class, function ($faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->sentence
    ];
});

$factory->define(CodeCommerce\Product::class, function ($faker) {
    return [
        'category_id' => $faker->numberBetween(1,10),
        'name' => $faker->word,
        'description' => $faker->sentence,
        'price' => $faker->randomNumber(2)
    ];
});