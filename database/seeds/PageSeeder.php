<?php

use Illuminate\Database\Seeder;
use VoceCrianca\Models\Page;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Page::class, 100)->create();
    }
}
