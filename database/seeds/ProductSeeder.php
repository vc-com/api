<?php

use App\Entities\Customer;
use App\Entities\User;
use App\Entities\Product;
use App\Entities\ProductImage;
use App\Entities\ProductRelated;
use App\Entities\ProductQuestion;
use App\Entities\ProductPrice;
use App\Entities\ProductStock;

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ProductSeeder extends Seeder
{

    protected $customer_id;

    public function run(Faker $faker)
    {

        $products = factory(Product::class,200)->create();

        $products->each(function ($product) use ($faker) {

            if ($product->type === Product::TYPE_ATTRIBUTE) {                
    
                $products = factory(Product::class, rand(1,6))->create([
                    'parent_id' => $product->id,
                    'type' => Product::TYPE_ATTRIBUTE
                ]);            

            }

            $total = rand(1,2);

            for ($i=0; $i < $total ; $i++) {
                $image = new ProductImage( $this->images( $faker ) );
                $product->images()->save($image);
            } 

            $total = rand(1,2);

            for ($i=0; $i < $total ; $i++) {
                $related = new ProductRelated( $this->relateds( $faker ) );
                $product->relateds()->save($related);
            }     
  
       
            $questions = factory(ProductQuestion::class, rand(0,5))->create();
            $product->questions()->attach($questions);        
    

        });

    }

    private function images(Faker $faker)
    {
        return [
            'image' => $faker->slug,
            'sort_order' => rand(0,10),
        ];
    }

    private function relateds(Faker $faker)
    {

        $product = Product::take(1)
            ->skip(rand( 0, Product::count() - 1) )
            ->first();

        return [
            'related_id' => $product->id,
        ];

    }

}
