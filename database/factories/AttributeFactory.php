<?php

use Faker\Generator as Faker;

$factory->define(VoceCrianca\Models\Attribute::class, function (Faker $faker) {
    return [
        'active' => array_random([true, false]),
        'name' => $faker->sentence,
        'type' => $faker->name,        
    ];
});
