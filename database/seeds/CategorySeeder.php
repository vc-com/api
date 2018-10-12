<?php

use VoceCrianca\Models\Category;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class CategorySeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {        

        $categories = factory(Category::class,10)->create(); 

		$categories->each(function ($category) {
			
			$categories = factory(Category::class,5)->create([
                'parent_id' => $category->id 
            ]);

            $categories->each(function ($category) {
            
                $categories = factory(Category::class,2)->create([
                    'parent_id' => $category->id 
                ]); 

                $categories->each(function ($category) {
            
                    $categories = factory(Category::class,3)->create([
                        'parent_id' => $category->id 
                    ]); 

                    $categories->each(function ($category) {
            
                        $categories = factory(Category::class,3)->create([
                            'parent_id' => $category->id 
                        ]); 

                        $categories->each(function ($category) {
            
                            $categories = factory(Category::class,3)->create([
                                'parent_id' => $category->id 
                            ]); 

                        });


                    });


                });


            });


		});


    }


}
