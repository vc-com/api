<?php

use VoceCrianca\Models\Banner;
use VoceCrianca\Models\PagePublication;
use VoceCrianca\Models\PositionPublication;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->generateBanner(
            PositionPublication::FULLBANNER, 
            PagePublication::HOME
        );

        $this->generateBanner(
            PositionPublication::TARJA, 
            PagePublication::HOME
        );

        $this->generateBanner(
            PositionPublication::TARJA, 
            PagePublication::CATEGORY
        );

    }

    private function generateBanner($position, $page)
    {
        $banners = factory(Banner::class, 1)->create();

        $banners->each(function ($banner) use ($position, $page) {

            $attachPosition = PositionPublication::where('position_publication', $position)->first();
            $banner->positions()->attach($attachPosition);

            $attachPage = PagePublication::where('page_publication', $page)->first();
            $banner->pages()->attach($attachPage);

        });

    }

}