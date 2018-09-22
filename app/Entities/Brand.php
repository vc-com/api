<?php

namespace App\Entities;

use Jenssegers\Mongodb\Eloquent\Model;

class Brand extends Model
{
    /**
     * @var string
     */
    // public $table = 'brands';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'active',
        'title',
        'description',
        'slug',
        'target',
        'image',
        'sort_order',
    ];
}
