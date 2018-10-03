<?php

namespace App\Entities;

use Jenssegers\Mongodb\Eloquent\Model;

class ProductRelated extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'related_id',
    ];

    protected $hidden = [

    ];
    
}
