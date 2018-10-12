<?php

use Faker\Generator as Faker;

$factory->define(VoceCrianca\Models\Page::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'active' => rand(0,5) > 0 ? true : false,
        'description' => $faker->text,
        'slug' => $faker->slug,
        'meta_title' => $faker->sentence,
        'meta_description' => $faker->text,
        'sort_order' => rand(0,5)
    ];
});
