<?php

use App\Entities\Customer;
use App\Entities\User;
use App\Entities\Product;
use App\Entities\ProductImage;
use App\Entities\ProductRelated;
use App\Entities\ProductQuestion;

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ProductSeeder extends Seeder
{

    protected $customer_id;

    public function run(Faker $faker)
    {

        $products = factory(Product::class,20)->create();

        $products->each(function ($product) use ($faker) {

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

            $total = rand(0,5);
            for ($i=0; $i < $total ; $i++) {
                $question = new ProductQuestion( $this->questions( $faker, $i ) );
                $product->questions()->save($question);

                /*
                * Inserir codigos de respostas
                */          
        
            }         

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

    private function questions(Faker $faker, $i)
    {

        if($i % 2 == 0){

            $customer = Customer::take(1)
            ->skip(rand( 0, Customer::count() - 1) )
            ->first();

            return [
                'customer_id' =>  $customer->_id,
                'question' => $faker->text,
            ];
        }

        $user = User::take(1)
            ->skip(rand( 0, User::count() - 1) )
            ->first();

        return [
            'user_id' => $user->id,
            'question' => $faker->text,
        ];

    }

}
