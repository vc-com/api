<?php

use Faker\Generator as Faker;

$factory->define(App\Entities\Product::class, function (Faker $faker) {
    return [
    	'type' = array_random([Product::TYPE_NORMAL, Product::TYPE_ATTRIBUTE]),
    	'active' => array_random([true, false]),
    	'featured' => array_random([true, false]),
		'sku' => str_random(10),
		'name' => sprintf('%s %s', $faker->title, $faker->name),
		'slug' => $faker->slug,
		'description' => $faker->text,
		'tag' => $faker->name,
		'meta_title' => $faker->name,
		'meta_description' => $faker->text,
    ];
});
