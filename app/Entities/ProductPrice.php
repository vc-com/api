<?php

namespace App\Entities;

use Jenssegers\Mongodb\Eloquent\Model;

class ProductPrice extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'price_on_request', // preco_sob_consulta
		'price_cost', // preco_custo
		'price_full', // preco_cheio
		'price_promotional', // preco_promocional
	];

    protected $hidden = [

    ];
    
}
