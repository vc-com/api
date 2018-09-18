<?php

namespace App\Entities;

use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;
use App\Entities\User;

class Role extends Model
{

    use SoftDeletes;

    const ADMIN            = 'ADMIN';
    const STAFF_FINANCE    = 'STAFF_FINANCE';
    const STAFF_EDITOR     = 'STAFF_EDITOR';
    const STAFF_EXPEDITION = 'STAFF_EXPEDITION';

    public $table = 'roles';

    protected $fillable = [
        'name',
        'description',
        'default',
        'privileges'
    ];

    protected $dates = ['deleted_at'];

    /**
     * @return \Jenssegers\Mongodb\Relations\EmbedsMany
     */
    public function privileges()
    {
        return $this->belongsToMany(Privilege::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

}
