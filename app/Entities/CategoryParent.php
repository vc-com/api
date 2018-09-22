<?php

namespace App\Entities;

use Jenssegers\Mongodb\Eloquent\Model;

class CategoryParent extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'active',
        'description',
        'slug',
        'image',
        'meta_title',
        'meta_description',
        'sort_order',
    ];
    
}
