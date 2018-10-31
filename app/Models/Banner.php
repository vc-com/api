<?php

namespace VoceCrianca\Models;

use Jenssegers\Mongodb\Eloquent\Model;

/**
 * Class Banner
 * @package VoceCrianca\Models
 */
class Banner extends Model
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
        'target',
        'image',
        'meta_title',
        'meta_description',
        'sort_order',
    ];

    public function setSlugAttribute($value)
    {

        if(!empty($value)) {
            $this->attributes['slug'] = str_slug($value);
        }
        
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function pages() {
        return $this->belongsToMany(PagePublication::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function positions() {
        return $this->belongsToMany(PositionPublication::class);
    }

}


