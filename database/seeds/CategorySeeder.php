<?php

use App\Entities\Category;
use App\Entities\CategoryParent;
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

        $categories= factory(Category::class,20)->create();
        $categories->each(function ($customer) use ($faker) {

            $total = rand(2,10);
            for ($i=0; $i < $total ; $i++) {
                $parents = new CategoryParent( $this->parents( $faker, $i ) );
                $customer->parents()->save($parents);
            }       

        });

    }

    private function parents(Faker $faker, $i=0)
    {
        return [
            'nleft' => $i,
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
