<?php

use Illuminate\Database\Seeder;
use VoceCrianca\Models\Attribute;
use VoceCrianca\Models\AttributeVariation;
use VoceCrianca\Models\AttributeGroup;

class AttributeSeeder extends Seeder
{

    private $attributes = [

        ['name' => 'Gênero', 'default' => true],
        ['name' => 'Produto com uma cor', 'default' => true],
        ['name' => 'Produto com duas cores', 'default' => true],
        ['name' => 'Tamanho de anel/aliança', 'default' => true],
        ['name' => 'Tamanho de calça', 'default' => true],
        ['name' => 'Tamanho de camisa/camiseta', 'default' => true],
        ['name' => 'Tamanho de tênis', 'default' => true],

    ];

    private $genre = [
        ['name' => 'Feminino'],
        ['name' => 'Masculino'],
    ];

    private $color = [
        ['name' => 'Creme', 'color' => '#FFF2CC'],
        ['name' => 'Marrom', 'color' => '#B45F06'],
        ['name' => 'Vermelho', 'color' => '#FF0000'],
        ['name' => 'Cinza Claro', 'color' => '#CCCCCC'],
        ['name' => 'Púrpura', 'color' => '#741B47'],
        ['name' => 'Laranja', 'color' => '#FF9900'],
        ['name' => 'Fúcsia', 'color' => '#E828FF'],
        ['name' => 'Lilás', 'color' => '#8E7CC3'],
        ['name' => 'Marrom amarelado', 'color' => '#F6B26B'],
        ['name' => 'Ciano escuro', 'color' => '#76A5AF'],
        ['name' => 'Verde escuro', 'color' => '#38761D'],
        ['name' => 'Rosa', 'color' => '#F4CCCC'],
        ['name' => 'Esmeralda', 'color' => '#93C47D'],
        ['name' => 'Salmão', 'color' => '#EAD1DC'],
        ['name' => 'Verde', 'color' => '#0C9800'],
        ['name' => 'Fúcsia escuro', 'color' => '#C27BA0'],
        ['name' => 'Dourado', 'color' => '#BF9000'],
        ['name' => 'Lavanda', 'color' => '#D9D2E9'],
        ['name' => 'Água', 'color' => '#83DDFF'],
        ['name' => 'Azul Céu', 'color' => '#D0E0E3'],
        ['name' => 'Preto', 'color' => '#000000'],
        ['name' => 'Azul', 'color' => '#1717FF'],
        ['name' => 'Azul claro', 'color' => '#CFE2F3'],
        ['name' => 'Azul aço', 'color' => '#6FA8DC'],
        ['name' => 'Vermelho escuro', 'color' => '#990000'],
        ['name' => 'Azul escuro', 'color' => '#0B5394'],
        ['name' => 'Índigo', 'color' => '#351C75'],
        ['name' => 'Branco', 'color' => '#FFFFFF'],
        ['name' => 'Branco Navajo', 'color' => '#FCE5CD'],
        ['name' => 'Mocassim', 'color' => '#FFD966'],
        ['name' => 'Azul petróleo', 'color' => '#134F5C'],
        ['name' => 'Amarelo', 'color' => '#FFFF00'],
        ['name' => 'Terracota', 'color' => '#E06666'],
        ['name' => 'Violeta escuro', 'color' => '#7600FF'],
        ['name' => 'Cinza', 'color' => '#666666'],
        ['name' => 'Verde claro', 'color' => '#D9EAD3'],

    ];

    private $alliance = [

        ['name' => '10'],
        ['name' => '11'],
        ['name' => '12'],
        ['name' => '13'],
        ['name' => '14'],
        ['name' => '15'],
        ['name' => '16'],
        ['name' => '17'],
        ['name' => '18'],
        ['name' => '19'],
        ['name' => '20'],
        ['name' => '21'],
        ['name' => '22'],
        ['name' => '23'],
        ['name' => '24'],
        ['name' => '25'],
        ['name' => '26'],
        ['name' => '27'],
        ['name' => '28'],
        ['name' => '29'],
        ['name' => '30'],
        ['name' => '31'],
        ['name' => '32'],
        ['name' => '33'],
        ['name' => '34'],
        ['name' => '35'],
        ['name' => '36'],
        ['name' => '37'],
        ['name' => '38'],
        ['name' => '39'],
        ['name' => '40'],

    ];

    private $pants = [

        ['name' => '34'],
        ['name' => '36'],
        ['name' => '38'],
        ['name' => '40'],
        ['name' => '42'],
        ['name' => '44'],
        ['name' => '46'],
        ['name' => '48'],
        ['name' => '50'],
        ['name' => '52'],
        ['name' => '54'],
        ['name' => '56'],
        ['name' => '58'],
        ['name' => '60'],

    ];

    private $shirts = [

        ['name' => '1'],
        ['name' => '2'],
        ['name' => '3'],
        ['name' => '4'],
        ['name' => '5'],
        ['name' => 'G'],
        ['name' => 'GG'],
        ['name' => 'M'],
        ['name' => 'P'],
        ['name' => 'PP'],
        ['name' => 'U'],
        ['name' => 'XG'],
        ['name' => 'XGG'],

    ];

    private $sneakers = [

        ['name' => '53-54'],
        ['name' => '55-56'],
        ['name' => '57-58'],
        ['name' => '59-60'],
        ['name' => '61-62'],
        ['name' => '63-64'],
        ['name' => '16'],
        ['name' => '17'],
        ['name' => '18'],
        ['name' => '19'],
        ['name' => '20'],
        ['name' => '21'],
        ['name' => '22'],
        ['name' => '23'],
        ['name' => '24'],
        ['name' => '25'],
        ['name' => '26'],
        ['name' => '27'],
        ['name' => '28'],
        ['name' => '29'],
        ['name' => '30'],
        ['name' => '31'],
        ['name' => '32'],
        ['name' => '33'],
        ['name' => '34'],
        ['name' => '35'],
        ['name' => '36'],
        ['name' => '37'],
        ['name' => '38'],
        ['name' => '39'],
        ['name' => '40'],
        ['name' => '41'],
        ['name' => '42'],
        ['name' => '43'],
        ['name' => '44'],
        ['name' => '45'],
        ['name' => '46'],
        ['name' => '47'],

    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->genre();
        $this->productOneColor();
        $this->productTwoColors();
        $this->sizeAlliance();
        $this->sizePants();
        $this->sizeShirts();
        $this->sizeSneakers();

    }

    private function genre()
    {
        $attribute = Attribute::create($this->attributes[0]);
        foreach ($this->genre as $key => $value) {
            $value['default']= true;
            $variation = new AttributeVariation( $value );
            $attribute->variations()->save($variation);
        }          
    }

    private function productOneColor()
    {
        $attribute = Attribute::create($this->attributes[1]);
        foreach ($this->color as $key => $value) {
            $value['default']= true;
            $variation = new AttributeVariation( $value );
            $attribute->variations()->save($variation);
        }
    }

    private function productTwoColors()
    {
        $attribute = Attribute::create($this->attributes[2]);
        foreach ($this->color as $key => $value) {
            $value['default']= true;
            $variation = new AttributeVariation( $value );
            $attribute->variations()->save($variation);
        } 
    }

    private function sizeAlliance()
    {
        $attribute = Attribute::create($this->attributes[3]);
        foreach ($this->alliance as $key => $value) {
            $value['default']= true;
            $variation = new AttributeVariation( $value );
            $attribute->variations()->save($variation);
        } 
    }

    private function sizePants()
    {
        $attribute = Attribute::create($this->attributes[4]);
        foreach ($this->pants as $key => $value) {
            $value['default']= true;
            $variation = new AttributeVariation( $value );
            $attribute->variations()->save($variation);
        } 
    }

    private function sizeShirts()
    {
        $attribute = Attribute::create($this->attributes[5]);
        foreach ($this->shirts as $key => $value) {
            $value['default']= true;
            $variation = new AttributeVariation( $value );
            $attribute->variations()->save($variation);
        } 
    }

    private function sizeSneakers()
    {
        $attribute = Attribute::create($this->attributes[6]);
        foreach ($this->sneakers as $key => $value) {
            $value['default']= true;
            $variation = new AttributeVariation( $value );
            $attribute->variations()->save($variation);
        } 
    }

}
