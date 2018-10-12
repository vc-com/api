<?php

use VoceCrianca\Models\User;
use VoceCrianca\Models\Customer;
use Faker\Generator as Faker;

$factory->define(VoceCrianca\Models\ProductQuestion::class, function (Faker $faker) {


	if(rand(0,1) % 2 == 0){

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

});
