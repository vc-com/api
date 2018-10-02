<?php

use Illuminate\Database\Seeder;
use App\Entities\Attribute;
use App\Entities\AttributeVariation;

use Faker\Generator as Faker;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        
        $attributes = factory(Attribute::class, 20)->create();

        $attributes->each(function ($attribute) use ($faker) {

            $total = rand(2,10);
            for ($i=0; $i < $total ; $i++) {
                $variation = new AttributeVariation( $this->variations( $faker ) );
                $attribute->variations()->save($variation);
            }        
  
        });

    }


    private function variations(Faker $faker)
    {
        return [
            'name' => str_random(20),
            'hex' => str_random(6),
        ];

    }

}
