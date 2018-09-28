<?php

use App\Entities\Category;
use App\Entities\CategoryParent;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class CategorySeeder extends Seeder
{

    private $parent_id = null;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        $categories = factory(Category::class,20)->create();
        $categories->each(function ($category) use ($faker) {

            $total = rand(2,10);
            for ($i=0; $i < $total ; $i++) {
                $parent = new CategoryParent( $this->parents( $faker, $i ) );

                $result = $category->parents()->save($parent);

                if($result->nleft == 0) {
                    $this->parent_id = $result->id;
                }

                if($result->nleft > 0) {

                    $array = [];
                    $array['parent_id'] = $this->parent_id;
                    $category->parents()->find($result->id)->update( $array );
                    
                }
        
            }       

        });

    }

    private function parents(Faker $faker, $i=0)
    {

        $nleft = $i > 1 ? rand(0,5) : 0;
        $nleft = $nleft <= 0 ? 0 : 1;

        return [

            'nleft' => $nleft,
            'name' => $faker->name,
            'active' => rand(0,5) > 0 ? true : false,
            'description' => $faker->text,
            'slug' => $faker->slug,
            'image' => null,
            'meta_title' => $faker->name,
            'meta_description' => $faker->text,
            'sort_order' => rand(0,5)

        ];
    }

}
