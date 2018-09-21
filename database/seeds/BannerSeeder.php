<?php

use App\Entities\Banner;
use App\Entities\PagePublication;
use App\Entities\PositionPublication;
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

        $this->generateBanner(PositionPublication::FULLBANNER, PagePublication::HOME);

    }

    private function generateBanner($localPosition, $pagePosition)
    {
        $banners = factory(Banner::class);

        $banners->each(function ($banner) use ($localPosition, $pagePosition) {

            $position = PositionPublication::where('position_publication', $localPosition)->first();
            $banner->positionPublication()->attach($position);

            $position = PositionPublication::where('page_publication', $pagePosition)->first();
            $banner->pagePublication()->attach($position);

        });

    }

}