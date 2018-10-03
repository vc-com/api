<?php

namespace App\Entities;

use Jenssegers\Mongodb\Eloquent\Model;

class ProductDiscount extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

		'customer_group_id',
		'quantity',
		'priority',
		'price',
		'date_start',
		'date_end',

    ];

    protected $hidden = [

    ];
    
}
