<?php


use App\Entities\Customer;
use App\Entities\CustomerAddress;
use App\Entities\CustomerPhone;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{

    public function run()
    {

        $customers= factory(Customer::class,20)->create();
        $customers->each(function ($customer) {

            $phones = factory(CustomerPhone::class, rand(1,2))->create();
            $customer->phones()->attach($phones);
            
            $address = factory(CustomerAddress::class, rand(1,2))->create();
            $customer->address()->attach($address);

        });

    }

}
