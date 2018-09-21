<?php

use Illuminate\Database\Seeder;
use App\Entities\PositionPublication;

class PositionPublicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->dataPagePositions() as $data) {
            PositionPublication::create([
                'name' => $data['name'],
                'position_publication' => $data['position_publication'],
            ]);
        }
    }


    private function dataPagePositions()
    {

        return [
            [
                'name' => 'Banner',
                'position_publication' => PositionPublication::BANNER,
            ],
            [
                'name' => 'Slider Full Banner',
                'position_publication' => PositionPublication::FULLBANNER,
            ],
            [
                'name' => 'Mini banner',
                'position_publication' => PositionPublication::MINIBANNER,
            ],
            [
                'name' => 'Slider Default Banner',
                'position_publication' => PositionPublication::SIDEBAR,
            ],
            [
                'name' => 'Banner Tarja',
                'position_publication' => PositionPublication::TARJA,
            ],
            [
                'name' => 'Banner Vitrine',
                'position_publication' => PositionPublication::VITRINE,
            ],

        ];

    }
    
}
