<?php

use Illuminate\Database\Seeder;
use App\Entities\Page;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Page::class, 8)->create();
    }
}
