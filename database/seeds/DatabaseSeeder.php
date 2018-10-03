<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // $this->call(PrivilegeSeeder::class);
        // $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        // $this->call(PagePublicationSeeder::class);
        // $this->call(PositionPublicationSeeder::class);
        // $this->call(BannerSeeder::class);
        // $this->call(BrandSeeder::class);
        // $this->call(CategorySeeder::class);
        // $this->call(PageSeeder::class);
        $this->call(CustomerSeeder::class);
        // $this->call(CouponSeeder::class);
        // $this->call(AttributeSeeder::class);
        $this->call(ProductSeeder::class);

    }

}
