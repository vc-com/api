<?php

use Faker\Generator as Faker;

$factory->define(App\Entities\Brand::class, function (Faker $faker) {

	// //download das imagens vindo do laravelpix.com
	// $imagemDownload = $faker->image(storage_path('app/public/img/banner'), 168,50);

	// //criando array do caminho das imagens
	// $imagePath = explode('/', $imagemDownload);

	// //setando um nome para a imagem
	// $imageName = end($imagePath);

    
    $imageName = false;
    $name = $faker->name;

    return [

        'name' => $name,
        'active' => rand(0,5) > 0 ? true : false,
        'description' => $faker->text,
        'slug' => $faker->slug,
        'image' => $imageName,
        'meta_title' => $name,
        'meta_description' => $faker->text,
        'sort_order' => rand(0,5)
        
    ];
    
});
