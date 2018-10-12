<?php

use Faker\Generator as Faker;

$factory->define(VoceCrianca\Models\Banner::class, function (Faker $faker) {

    //download das imagens vindo do laravelpix.com
    // $imagemDownload = $faker->image(storage_path('app/public/img/banner'), 468,60);

    // //criando array do caminho das imagens
    // $imagePath = explode('/', $imagemDownload);

    // //setando um nome para a imagem
    // $imageName = end($imagePath);

    $imageName = false;

    return [
        'name' => $faker->sentence,
		'active' => rand(0,5) > 0 ? true : false,
		'description' => $faker->text,
        'slug' => $faker->slug,
		'target' => array_random(['', '_blank']),
		'image' => $imageName,
		'meta_title' => $faker->sentence,
		'meta_description' => $faker->text,
		'sort_order' => rand(0,5)
    ];
    
});
