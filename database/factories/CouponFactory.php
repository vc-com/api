<?php

use Faker\Generator as Faker;
use App\Entities\Coupon;

$factory->define(Coupon::class, function (Faker $faker) {

    return [
        'active' => array_random([true, false]),
        'name' => $faker->name,
        'code' => str_random(20),
        'description' => $faker->text,
        'type' => array_random([
        	Coupon::FREE_SHIPPING, 
        	Coupon::PERCENTAGE, 
        	Coupon::FIXED
        ]),
        'uses_total' => rand(0,100),
        'uses_customer' => rand(0,100),
        'value' => rand(10,50),
        'minimum_value' =>  rand(80,100),
        'quantities' => rand(10,500),
        'apply_to_total' => array_random([true, false]),
        'cumulative' => array_random([true, false]),
        'quantity_by_customer' => rand(1,5),
        'used_total' => rand(1,100),
        'date_start' => date('Y-d-m'),
        'date_end' =>  date('Y-d-m'),
    ];

});
