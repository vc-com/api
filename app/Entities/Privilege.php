<?php

namespace App\Entities;

use App\Entities\Role;
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
        'name',
        'description',
    ];

    protected $dates = ['deleted_at'];


    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

}
