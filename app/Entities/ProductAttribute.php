<?php

namespace App\Entities;

use Jenssegers\Mongodb\Eloquent\Model;

class ProductAttribute extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'attribute_id',
		'text'
    ];

    protected $hidden = [

    ];
    
}
