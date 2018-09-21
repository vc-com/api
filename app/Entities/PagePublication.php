<?php

namespace App\Entities;

use Jenssegers\Mongodb\Eloquent\Model;

class PagePublication extends Model
{

    const HOME = 'home';
    const CATEGORY = 'category';
    const BRAND = 'brand';
    const BRAND = 'product';
    const SEARCH = 'search';
    const CONTENT = 'content';
    const ALL = 'all';


    /**
     * @var string
     */
    // public $table = 'page_publications';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',       
        'local_publication',
    ];
}
