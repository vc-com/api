<?php

use Faker\Generator as Faker;

$factory->define(App\Entities\Banner::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'active' => rand(0,5) > 0 ? true : false,
        'local_publication',
        'position_publication',
        'title' => $faker->title,
        'target' => array_random(['', '_blank']),
        'image' => $faker->url,
        'sort_order' => rand(0,5)
    ];
});
