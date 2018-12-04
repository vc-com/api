<?php

use Faker\Generator as Faker;

$factory->define(VoceCrianca\Models\Brand::class, function (Faker $faker) {

    if( rand(0,3) > 0 ) {

    	//download das imagens vindo do laravelpix.com
    	$imagemDownload = $faker->image(storage_path('app/public/img/brand-logo'), 144,63);

    	//criando array do caminho das imagens
    	$imagePath = explode('/', $imagemDownload);

    	//setando um nome para a imagem
    	$imageName = end($imagePath);

    } else {

        $imageName = false;
    }


    return [

        'name' => $faker->sentence,
        'active' => rand(0,5) > 0 ? true : false,
        'spotlight' => rand(0,5) > 0 ? true : false,
        'description' => $faker->text,
        'slug' => $faker->slug,
        'image' => $imageName,
        'meta_title' => $faker->sentence,
        'meta_description' => $faker->text,
        'sort_order' => rand(0,5)
        
    ];
    
});
