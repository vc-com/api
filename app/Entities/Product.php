<?php

namespace App\Entities;

use Jenssegers\Mongodb\Eloquent\Model;

use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Product extends Model
{

    const TYPE_ATTRIBUTE = 'attribute';
    const TYPE_NORMAL = 'normal';

	use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'parent_id',
        'type',
        'active',
        'name',
        'featured', //Destacar
        'used',
        'slug',
		'sku',
        'gtin',    
        'mpn',    
        'ncm',

        'description',	
		'tag',
		'meta_title',
        'meta_description',
		'meta_keywords',

        'url_video_youtube',
        'brand', 

        'weight', // peso
        'length', // comprimento
        'width', // largura
        'height', // altura

        'total_sold', // total_vendido
        'visualized'

    ];

    protected $hidden = [

    ];


    /**
     * @param $query
     * @param $search
     * @return mixed
     */
    public function scopeWhereFullText($query, $search)
    {
        $query->getQuery()->projections = [
            'score' => [ '$meta'=>'textScore' ]
        ];

        return $query->whereRaw([
            '$text' => [ '$search' => $search ]
        ]);

    }

    public function images()
    {
        return $this->embedsMany(ProductImage::class);
    }

    public function relateds()
    {
        return $this->embedsMany(ProductRelated::class);
    }

    public function questions()
    {
        return $this->embedsMany(ProductQuestion::class);
    }

    public function attributes()
    {
        return $this->embedsMany(ProductAttribute::class);
    }

    public function stocks()
    {
        return $this->embedsMany(ProductStock::class);
    }

    public function prices()
    {
        return $this->embedsMany(ProductPrice::class);
    }
    
}
