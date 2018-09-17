<?php

namespace App\Entities;

use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Privilege extends Model
{

    use SoftDeletes;

    const ALL     = 'ALL';
    const READ    = 'READ';
    const ADD     = 'ADD';
    const EDIT    = 'EDIT';
    const DELETE  = 'DELETE';

    public $table = 'privileges';

    protected $fillable = [
        'uuid',
        'name',
        'description',
    ];

    protected $dates = ['deleted_at'];

}
