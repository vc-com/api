<?php

namespace App\Entities;

use Jenssegers\Mongodb\Eloquent\Model;

class PagePublication extends Model
{

    const ALL = 'all';
    const BRAND = 'brand';
    const CATEGORY = 'category';
    const CONTENT = 'content';
    const HOME = 'home';
    const PRODUCT = 'product';
    const SEARCH = 'search';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',       
        'page_publication',
    ];
}
