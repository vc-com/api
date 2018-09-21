<?php

namespace App\Entities;

use Jenssegers\Mongodb\Eloquent\Model;

/**
 * Class Banner
 * @package App\Entities
 */
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function pagePublication() {
        return $this->belongsToMany(PagePublication::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function positionPublication() {
        return $this->belongsToMany(PositionPublication::class);
    }

}


