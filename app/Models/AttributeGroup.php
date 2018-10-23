<?php

namespace VoceCrianca\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class AttributeGroup extends Model
{
    
    const GENRE = 'Gênero';
    const COLOR = 'Cor';
    const SIZE = 'Tamanho';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

    ];

    protected $hidden = [

    ];
    
}
