<?php

namespace VoceCrianca\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class CustomerPhone extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'number',
    ];

    protected $hidden = [

    ];
    
}
