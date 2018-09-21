<?php

namespace App\Entities;

use Jenssegers\Mongodb\Eloquent\Model;

class PositionPublication extends Model
{

    const TARJA = 'tarja';
    const VITRINE = 'vitrine';
    const FULLBANNER = 'fullbanner';
    const MINIBANNER = 'minibanner';
    const SIDEBAR = 'sidebar';
    const BANNER = 'banner';
    const DEFAULT = 'default';


    /**
     * @var string
     */
    // public $table = 'position_publications';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'position_publication',
    ];
}