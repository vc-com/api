<?php

use VoceCrianca\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{

    public function run()
    {
        factory(Brand::class, 100)->create();
    }

}
