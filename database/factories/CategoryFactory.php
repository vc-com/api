<?php

use Faker\Generator as Faker;

$factory->define(App\Entities\Category::class, function (Faker $faker) {

//	  //download das imagens vindo do laravelpix.com
//    $imagemDownload = $faker->image(storage_path('app/public/img/category'), 400,300);
//
//    //criando array do caminho das imagens
//    $imagePath = explode('/', $imagemDownload);
//
//    //setando um nome para a imagem
//    $imageName = end($imagePath);

    return [
        'parent_id' => 0,
        'name' => $faker->sentence,
        'active' => rand(0,5) > 0 ? true : false,
        'description' => $faker->text,
        'slug' => $faker->slug,
        'image' => $faker->slug,
        'meta_title' => $faker->sentence,
        'meta_description' => $faker->text,
        'sort_order' => rand(0,5)
    ];

});
    