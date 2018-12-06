<?php

namespace VoceCrianca\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Brand extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'active',
        'spotlight',
        'description',
        'slug',
        'image',
        'meta_title',
        'meta_description',
        'sort_order',
    ];
    
    public function setSlugAttribute($value)
    {

        if (!empty($value)) {
            $this->attributes['slug'] = str_slug($value);
        }

    }

    public function getImageAttribute($value)
    {

        if (!empty($value)) {
            return asset('storage/img/brand-logo/' . $value);
        }

        return "";

    }

}
