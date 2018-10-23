<?php

namespace VoceCrianca\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class CustomerAddress extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'address',
        'postcode',
    ];

    protected $hidden = [

    ];

}
