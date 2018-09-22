<?php

use Faker\Generator as Faker;

$factory->define(App\Entities\Brand::class, function (Faker $faker) {

	//download das imagens vindo do laravelpix.com
	$imagemDownload = $faker->image(storage_path('app/public/img/banner'), 168,50);
	//criando array do caminho das imagens
	$imagePath = explode('/', $imagemDownload);
	//setando um nome para a imagem
	$imageName = end($imagePath);

    return [
        'name' => $faker->name,
        'active' => rand(0,5) > 0 ? true : false,
        'title' => $faker->title,
        'description' => $faker->text,
        'slug' => $faker->slug,
        'target' => array_random(['', '_blank']),
        'image' => $imageName,
        'sort_order' => rand(0,5)
    ];
    
});
