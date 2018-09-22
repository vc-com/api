<?php

namespace App\Entities;

use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

/**
 * Class Role
 * @package App\Entities
 */
class Role extends Model
{

    use SoftDeletes;

    const ADMIN            = 'ADMIN';
    const STAFF_FINANCE    = 'STAFF_FINANCE';
    const STAFF_EDITOR     = 'STAFF_EDITOR';
    const STAFF_EXPEDITION = 'STAFF_EXPEDITION';

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
        return $this->embedsMany(Privilege::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

}
