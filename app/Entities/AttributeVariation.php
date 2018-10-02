<?php

namespace App\Entities;

use Jenssegers\Mongodb\Eloquent\Model;

class AttributeVariation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'hex'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];
    
}
