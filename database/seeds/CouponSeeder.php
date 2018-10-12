<?php

use Illuminate\Database\Seeder;
use VoceCrianca\Models\Coupon;
use VoceCrianca\Models\CouponHistory;
use VoceCrianca\Models\CouponCategory;
use VoceCrianca\Models\CouponProduct;
use Faker\Generator as Faker;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        
        $coupons = factory(Coupon::class, 20)->create();

        $coupons->each(function ($coupon) use ($faker) {

            $total = rand(2,10);
            for ($i=0; $i < $total ; $i++) {
                $category = new CouponCategory( $this->categories( $faker ) );
                $coupon->categories()->save($category);
            }        

            $total = rand(2,10);
            for ($i=0; $i < $total ; $i++) {
                $history = new CouponHistory( $this->histories( $faker ) );
                $coupon->histories()->save($history);
            }

            $total = rand(2,10);
            for ($i=0; $i < $total ; $i++) {
                $product = new CouponProduct( $this->products( $faker ) );
                $coupon->products()->save($product);
            }    
       

        });


    }


    private function categories(Faker $faker)
    {
        return [
            'category_id' => str_random(20),
        ];
    }

    private function histories(Faker $faker)
    {
        return [
            'order_id' => str_random(20),
            'customer_id' => str_random(20),
            'amount' => rand(100,500),
        ];

    }

    private function products(Faker $faker)
    {
        return [
            'product_id' => str_random(20),
        ];

    }

}
