<?php

use App\Entities\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{

    public function run()
    {
        factory(Brand::class, 8)->create();
    }

}
