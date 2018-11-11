<?php

namespace VoceCrianca\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Attribute extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'type',
        'default',
        'slug'
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    public function setNameAttribute($value)
    {   
        if(!empty($value)) {
            $this->attributes['name'] = $value;
            $this->attributes['slug'] = str_slug( $value );
        }
        
    }

    /**
     * @return \Jenssegers\Mongodb\Relations\EmbedsMany
     */
    public function variations()
    {
        return $this->embedsMany(AttributeVariation::class);
    }

}
