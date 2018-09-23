<?php

use App\Entities\Category;
use App\Entities\CategoryParent;
use App\Entities\CategoryParentTree;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	
        $categories = factory(Category::class, 8)->create();

        $categories->each(function($category) {

            $parents = factory(CategoryParent::class, rand(1,2))->create([
                'parent_id' => $category->id,
                'nleft' => 0
            ]);

            foreach ($parents as $key => $value) {
            	$id = $value->id;
            }

            $category->parents()->attach($parents);

            $parents = factory(CategoryParent::class, rand(1,2))->create([
                'parent_id' =>$id,
                'nleft' => 1
            ]);

            $category->parents()->attach($parents);

        });

    }

}
