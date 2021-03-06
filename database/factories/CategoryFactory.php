<?php

use Faker\Generator as Faker;

define('DIRECTORY', storage_path("app". DS ."public". DS ."img".  DS ."category-logo"));

if(!file_exists(DIRECTORY)) {
    mkdir(DIRECTORY, 700);
}


$factory->define(VoceCrianca\Models\Category::class, function (Faker $faker) {

        //download das imagens vindo do laravelpix.com
        $imagemDownload = $faker->image(DIRECTORY, 144,63);

        //criando array do caminho das imagens
        $imagePath = explode(DS, $imagemDownload);

        //setando um nome para a imagem
        $imageName = end($imagePath);

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
    
