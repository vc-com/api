<?php

namespace App\Entities;

use Jenssegers\Mongodb\Eloquent\Model;

class ProductImage extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'image',
		'sort_order',
    ];

    protected $hidden = [

    ];
    
}
