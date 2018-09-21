<?php

namespace App\Entities;

use Jenssegers\Mongodb\Eloquent\Model;

class Banner extends Model
{

    /**
     * @var string
     */
    // public $table = 'banners';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'name',
		'active',          
		'local_publication',
		'page_publication',
		'title',
		'target',
		'image',
		'sort_order'
    ];

}


