<?php

namespace VoceCrianca\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Category extends Model
{
    //https://www.sitepoint.com/community/t/php-recursive-multidimensional-array-to-html-nested-code/256533

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parent_id',
        'name',
        'active',
        'description',
        'slug',
        'image',
        'meta_title',
        'meta_description',
        'sort_order',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    // /**
    //  * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    //  */
    // public function parents()
    // {
    //     return $this->belongsTo(CategoryParent::class);
    // }

    public function setSlugAttribute($value)
    {

        if(!empty($value)) {
            $this->attributes['slug'] = str_slug($value);
        }
        
    }
    
}
