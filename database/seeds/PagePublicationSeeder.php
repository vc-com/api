<?php

use Illuminate\Database\Seeder;
use App\Entities\PagePublication;

class PagePublicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->dataPagePositions() as $data) {
            PagePublication::create([
                'name' => $data->name,
                'page_publication' => $data->page_publication,
            ]);
        }
    }

    private function dataPagePositions()
    {

        return [
            [
                'name' => 'Em todas as páginas',
                'page_publication' => PagePublication::ALL,
            ],
            [
                'name' => 'Em todas as marcas',
                'page_publication' => PagePublication::BRAND,
            ],
            [
                'name' => 'Em todas as categorias',
                'page_publication' => PagePublication::CATEGORY,
            ],
            [
                'name' => 'Nas páginas de conteúdo',
                'page_publication' => PagePublication::CONTENT,
            ],
            [
                'name' => 'Somente na página inicial',
                'page_publication' => PagePublication::HOME,
            ],
            [
                'name' => 'Em todos os produtos',
                'page_publication' => PagePublication::PRODUCT,
            ],
            [
                'name' => 'Na página de busca',
                'page_publication' => PagePublication::SEARCH,
            ],

        ];

    }

}
