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



//   'quantity',


//   'preco_sob_consulta' enum('True') DEFAULT NULL,
//   'preco_custo' double(10,2) DEFAULT NULL,
//   'preco_cheio' double(10,2) DEFAULT NULL,
//   'preco_promocional' double(10,2) DEFAULT NULL,
//   'peso' decimal(10,3) DEFAULT NULL,
//   'altura' int(11) DEFAULT NULL,
//   'largura' int(11) DEFAULT NULL,
//   'comprimento' int(11) DEFAULT NULL,
//   'gerenciado' enum('False','True') DEFAULT 'False',
//   'situacao_em_estoque' int(11) DEFAULT NULL,
//   'quantidade' int(11) DEFAULT NULL,
//   'reservado' int(11) DEFAULT '0',
//   'total_vendido' int(11) DEFAULT '0',
//   'situacao_sem_estoque' int(11) DEFAULT NULL,



		// 'stock_status_id',
		// 'image',
		// 'manufacturer_id',
		// 'shipping',
		// 'price',
		// 'points',
		// 'date_available',
		// 'weight',
		// 'length',
		// 'width',
		// 'height',
		// 'minimum',
		// 'sort_order',
		// 'status',
		// 'viewed',

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
    
}
