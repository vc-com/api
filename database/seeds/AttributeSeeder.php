<?php

use Illuminate\Database\Seeder;
use App\Entities\Attribute;
use App\Entities\AttributeVariation;
use App\Entities\AttributeGroup;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        foreach ($this->attributes() as $key => $attr) {

            $attributes = Attribute::create($attr);

            $attributes->each(function ($attribute) use ($attr) {

                foreach ($this->variations() as $key => $var) {

                    $data = [
                        'name' => $var['name'],
                        'color' => isset( $var['color'] ) ? $var['color'] : null,
                    ];

                    if (is_null($data['color'])) {
                        unset($data['color']);
                    }

                    if($attr[0] === $var[0]) {
                        $variation = new AttributeVariation( $data );
                        $attribute->variations()->save($variation);  
                    }

                }               

            });

        }

    }


    public function attributes()
    {
        return [

            ['1', 'name' => 'Gênero', 'type' => AttributeGroup::GENRE ],
            ['2', 'name' => 'Produto com uma cor', 'type' => AttributeGroup::COLOR ],
            ['3', 'name' => 'Produto com duas cores', 'type' => AttributeGroup::COLOR ],
            ['4', 'name' => 'Tamanho de anel/aliança', 'type' => AttributeGroup::SIZE ],
            ['5', 'name' => 'Tamanho de calça', 'type' => AttributeGroup::SIZE ],
            ['6', 'name' => 'Tamanho de camisa/camiseta', 'type' => AttributeGroup::SIZE ],
            ['7', 'name' => 'Tamanho de tênis', 'type' => AttributeGroup::SIZE ],

        ];

    }


    private function variations()
    {

        return [

            ['1', 'name' => 'Feminino'],
            ['1', 'name' => 'Masculino'],
            ['4', 'name' => '10'],
            ['4', 'name' => '11'],
            ['4', 'name' => '12'],
            ['4', 'name' => '13'],
            ['4', 'name' => '14'],
            ['4', 'name' => '15'],
            ['4', 'name' => '16'],
            ['4', 'name' => '17'],
            ['4', 'name' => '18'],
            ['4', 'name' => '19'],
            ['4', 'name' => '20'],
            ['4', 'name' => '21'],
            ['4', 'name' => '22'],
            ['4', 'name' => '23'],
            ['4', 'name' => '24'],
            ['4', 'name' => '25'],
            ['4', 'name' => '26'],
            ['4', 'name' => '27'],
            ['4', 'name' => '28'],
            ['4', 'name' => '29'],
            ['4', 'name' => '30'],
            ['4', 'name' => '31'],
            ['4', 'name' => '32'],
            ['4', 'name' => '33'],
            ['4', 'name' => '34'],
            ['4', 'name' => '35'],
            ['4', 'name' => '36'],
            ['4', 'name' => '37'],
            ['4', 'name' => '38'],
            ['4', 'name' => '39'],
            ['4', 'name' => '40'],
            ['5', 'name' => '34'],
            ['5', 'name' => '36'],
            ['5', 'name' => '38'],
            ['5', 'name' => '40'],
            ['5', 'name' => '42'],
            ['5', 'name' => '44'],
            ['5', 'name' => '46'],
            ['5', 'name' => '48'],
            ['5', 'name' => '50'],
            ['5', 'name' => '52'],
            ['5', 'name' => '54'],
            ['5', 'name' => '56'],
            ['5', 'name' => '58'],
            ['5', 'name' => '60'],
            ['6', 'name' => '1'],
            ['6', 'name' => '2'],
            ['6', 'name' => '3'],
            ['6', 'name' => '4'],
            ['6', 'name' => '5'],
            ['6', 'name' => 'G'],
            ['6', 'name' => 'GG'],
            ['6', 'name' => 'M'],
            ['6', 'name' => 'P'],
            ['6', 'name' => 'PP'],
            ['6', 'name' => 'U'],
            ['6', 'name' => 'XG'],
            ['6', 'name' => 'XGG'],
            ['7', 'name' => '53-54'],
            ['7', 'name' => '55-56'],
            ['7', 'name' => '57-58'],
            ['7', 'name' => '59-60'],
            ['7', 'name' => '61-62'],
            ['7', 'name' => '63-64'],
            ['7', 'name' => '16'],
            ['7', 'name' => '17'],
            ['7', 'name' => '18'],
            ['7', 'name' => '19'],
            ['7', 'name' => '20'],
            ['7', 'name' => '21'],
            ['7', 'name' => '22'],
            ['7', 'name' => '23'],
            ['7', 'name' => '24'],
            ['7', 'name' => '25'],
            ['7', 'name' => '26'],
            ['7', 'name' => '27'],
            ['7', 'name' => '28'],
            ['7', 'name' => '29'],
            ['7', 'name' => '30'],
            ['7', 'name' => '31'],
            ['7', 'name' => '32'],
            ['7', 'name' => '33'],
            ['7', 'name' => '34'],
            ['7', 'name' => '35'],
            ['7', 'name' => '36'],
            ['7', 'name' => '37'],
            ['7', 'name' => '38'],
            ['7', 'name' => '39'],
            ['7', 'name' => '40'],
            ['7', 'name' => '41'],
            ['7', 'name' => '42'],
            ['7', 'name' => '43'],
            ['7', 'name' => '44'],
            ['7', 'name' => '45'],
            ['7', 'name' => '46'],
            ['7', 'name' => '47'],
            ['2', 'name' => 'Creme', 'color' => '#FFF2CC'],
            ['2', 'name' => 'Marrom', 'color' => '#B45F06'],
            ['2', 'name' => 'Vermelho', 'color' => '#FF0000'],
            ['2', 'name' => 'Cinza Claro', 'color' => '#CCCCCC'],
            ['2', 'name' => 'Púrpura', 'color' => '#741B47'],
            ['2', 'name' => 'Laranja', 'color' => '#FF9900'],
            ['2', 'name' => 'Fúcsia', 'color' => '#E828FF'],
            ['2', 'name' => 'Lilás', 'color' => '#8E7CC3'],
            ['2', 'name' => 'Marrom amarelado', 'color' => '#F6B26B'],
            ['2', 'name' => 'Ciano escuro', 'color' => '#76A5AF'],
            ['2', 'name' => 'Verde escuro', 'color' => '#38761D'],
            ['2', 'name' => 'Rosa', 'color' => '#F4CCCC'],
            ['2', 'name' => 'Esmeralda', 'color' => '#93C47D'],
            ['2', 'name' => 'Salmão', 'color' => '#EAD1DC'],
            ['2', 'name' => 'Verde', 'color' => '#0C9800'],
            ['2', 'name' => 'Fúcsia escuro', 'color' => '#C27BA0'],
            ['2', 'name' => 'Dourado', 'color' => '#BF9000'],
            ['2', 'name' => 'Lavanda', 'color' => '#D9D2E9'],
            ['2', 'name' => 'Água', 'color' => '#83DDFF'],
            ['2', 'name' => 'Azul Céu', 'color' => '#D0E0E3'],
            ['2', 'name' => 'Preto', 'color' => '#000000'],
            ['2', 'name' => 'Azul', 'color' => '#1717FF'],
            ['2', 'name' => 'Azul claro', 'color' => '#CFE2F3'],
            ['2', 'name' => 'Azul aço', 'color' => '#6FA8DC'],
            ['2', 'name' => 'Vermelho escuro', 'color' => '#990000'],
            ['2', 'name' => 'Azul escuro', 'color' => '#0B5394'],
            ['2', 'name' => 'Índigo', 'color' => '#351C75'],
            ['2', 'name' => 'Branco', 'color' => '#FFFFFF'],
            ['2', 'name' => 'Branco Navajo', 'color' => '#FCE5CD'],
            ['2', 'name' => 'Mocassim', 'color' => '#FFD966'],
            ['2', 'name' => 'Azul petróleo', 'color' => '#134F5C'],
            ['2', 'name' => 'Amarelo', 'color' => '#FFFF00'],
            ['2', 'name' => 'Terracota', 'color' => '#E06666'],
            ['2', 'name' => 'Violeta escuro', 'color' => '#7600FF'],
            ['2', 'name' => 'Cinza', 'color' => '#666666'],
            ['2', 'name' => 'Verde claro', 'color' => '#D9EAD3'],
            ['3', 'name' => 'Creme', 'color' => '#FFF2CC'],
            ['3', 'name' => 'Marrom', 'color' => '#B45F06'],
            ['3', 'name' => 'Vermelho', 'color' => '#FF0000'],
            ['3', 'name' => 'Cinza Claro', 'color' => '#CCCCCC'],
            ['3', 'name' => 'Púrpura', 'color' => '#741B47'],
            ['3', 'name' => 'Laranja', 'color' => '#FF9900'],
            ['3', 'name' => 'Fúcsia', 'color' => '#E828FF'],
            ['3', 'name' => 'Lilás', 'color' => '#8E7CC3'],
            ['3', 'name' => 'Marrom amarelado', 'color' => '#F6B26B'],
            ['3', 'name' => 'Ciano escuro', 'color' => '#76A5AF'],
            ['3', 'name' => 'Verde escuro', 'color' => '#38761D'],
            ['3', 'name' => 'Rosa', 'color' => '#F4CCCC'],
            ['3', 'name' => 'Esmeralda', 'color' => '#93C47D'],
            ['3', 'name' => 'Salmão', 'color' => '#EAD1DC'],
            ['3', 'name' => 'Verde', 'color' => '#0C9800'],
            ['3', 'name' => 'Fúcsia escuro', 'color' => '#C27BA0'],
            ['3', 'name' => 'Dourado', 'color' => '#BF9000'],
            ['3', 'name' => 'Lavanda', 'color' => '#D9D2E9'],
            ['3', 'name' => 'Água', 'color' => '#83DDFF'],
            ['3', 'name' => 'Azul Céu', 'color' => '#D0E0E3'],
            ['3', 'name' => 'Preto', 'color' => '#000000'],
            ['3', 'name' => 'Azul', 'color' => '#1717FF'],
            ['3', 'name' => 'Azul claro', 'color' => '#CFE2F3'],
            ['3', 'name' => 'Azul aço', 'color' => '#6FA8DC'],
            ['3', 'name' => 'Vermelho escuro', 'color' => '#990000'],
            ['3', 'name' => 'Azul escuro', 'color' => '#0B5394'],
            ['3', 'name' => 'Índigo', 'color' => '#351C75'],
            ['3', 'name' => 'Branco', 'color' => '#FFFFFF'],
            ['3', 'name' => 'Branco Navajo', 'color' => '#FCE5CD'],
            ['3', 'name' => 'Mocassim', 'color' => '#FFD966'],
            ['3', 'name' => 'Azul petróleo', 'color' => '#134F5C'],
            ['3', 'name' => 'Amarelo', 'color' => '#FFFF00'],
            ['3', 'name' => 'Terracota', 'color' => '#E06666'],
            ['3', 'name' => 'Violeta escuro', 'color' => '#7600FF'],
            ['3', 'name' => 'Cinza', 'color' => '#666666'],
            ['3', 'name' => 'Verde claro', 'color' => '#D9EAD3'],

        ];    

    }

}
