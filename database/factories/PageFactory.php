<?php

use Faker\Generator as Faker;

$factory->define(App\Entities\Page::class, function (Faker $faker) {
    return [
        'name' => $faker->title,
        'active' => rand(0,5) > 0 ? true : false,
        'description' => $faker->text,
        'slug' => $faker->slug,
        'meta_title' => $faker->title,
        'meta_description' => $faker->text,
        'sort_order' => rand(0,5)
    ];
});
