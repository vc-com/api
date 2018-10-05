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


            if ($product->type === Product::TYPE_NORMAL) {
                
                $price = new ProductPrice( $this->prices( $faker ) );
                $product->prices()->save($price); 


                $price = new ProductStock( $this->stocks( $faker ) );
                $product->stocks()->save($price);

            } else {


                $products = factory(Product::class, rand(1,6))->create([
                    'parent_id' => $product->id,
                    'type' => Product::TYPE_ATTRIBUTE
                ]);

                $products->each(function ($product) use ($faker) {

                    $price = new ProductPrice( $this->prices( $faker ) );
                    $product->prices()->save($price); 

                    $price = new ProductStock( $this->stocks( $faker ) );
                    $product->stocks()->save($price);

                
                });

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

    private function stocks(Faker $faker)
    {
        return [

            'managed' => array_random([true, false]),
            'stock_status' => $faker->randomNumber(2),
            'quantity' => $faker->randomNumber(2),
            'reserved' => $faker->randomNumber(2),
            'situation_without_stock' => $faker->randomNumber(2),

        ];
    }

    private function prices(Faker $faker)
    {

        if(rand(0,1) === 1) {

            return [
                'price_on_request' => false, // preco_sob_consulta
                'price_cost' => $faker->randomNumber(2), // preco_custo
                'price_full' => $faker->randomNumber(2), // preco_cheio
                'price_promotional' => $faker->randomNumber(2), // preco_promocional
            ];

        }

        return [
            'price_on_request' => false, // preco_sob_consulta
            'price_cost' => $faker->randomNumber(2), // preco_custo
            'price_full' => $faker->randomNumber(2), // preco_cheio
            'price_promotional' => false, // preco_promocional
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
