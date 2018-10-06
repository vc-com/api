<?php

use App\Entities\Product;
use App\Entities\Brand;
use Faker\Generator as Faker;

$factory->define(App\Entities\Product::class, function (Faker $faker) {

	$brand = Brand::take(1)
		->skip(rand( 0, Brand::count() - 1) )
		->first();

    return [

		'type' => array_random([Product::TYPE_NORMAL, Product::TYPE_ATTRIBUTE]),
        'active' => array_random([true, false]),
        'parent_id' => 0,
        'name' => $faker->sentence,
        'featured' => array_random([true, false]),
        'used' => false,
        'slug' => $faker->slug,
		'sku' => str_random(10),
        'gtin' => str_random(10),
        'mpn' => str_random(10),
        'ncm' => str_random(10),

        'description' => $faker->paragraph,
		'tag' => $faker->name,
		'meta_title' => $faker->sentence,
		'meta_description' => $faker->paragraph,
		'meta_keywords' => $faker->paragraph,

        'url_video_youtube' => $faker->url,
        'brand' => $brand->name, 

        'weight' => rand(0.300,20) , // peso
        'length' => rand(1,99) , // comprimento
        'width' => rand(1,99) , // largura
        'height' => rand(1,99) , // altura

        'price_on_request' => false, // preco_sob_consulta
        'price_cost' => $faker->randomNumber(2), // preco_custo
        'price_full' => $faker->randomNumber(2), // preco_cheio
        'price_promotional' => $faker->randomNumber(2), // preco_promocional

        'managed' => array_random([true, false]),
        'stock_status' => $faker->randomNumber(2),
        'quantity' => $faker->randomNumber(2),
        'reserved' => $faker->randomNumber(2),
        'situation_without_stock' => $faker->randomNumber(2),

        'total_sold' => rand(0,10), // total_vendido
        'visualized' => rand(0,99),

    ];

});
