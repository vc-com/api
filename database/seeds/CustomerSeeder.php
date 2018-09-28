<?php

use App\Entities\Customer;
use App\Entities\CustomerAddress;
use App\Entities\CustomerPhone;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class CustomerSeeder extends Seeder
{

    public function run(Faker $faker)
    {

        $customers= factory(Customer::class,20)->create();
        $customers->each(function ($customer) use ($faker) {

            $total = rand(2,10);
            for ($i=0; $i < $total ; $i++) {
                $address = new CustomerAddress( $this->address( $faker ) );
                $customer->address()->save($address);
            }        

            $total = rand(2,10);

            for ($i=0; $i < $total ; $i++) {
                $phone = new CustomerPhone( $this->phones( $faker ) );
                $customer->phones()->save($phone);
            }            

        });

    }

    private function address(Faker $faker)
    {
        return [
            'address' => $faker->address,
            'postcode' => $faker->postcode,
        ];
    }

    private function phones(Faker $faker)
    {
        return [
            'number' => $faker->phoneNumber,
        ];

    }

}
