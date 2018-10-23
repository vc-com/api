<?php

namespace VoceCrianca\Models;

use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

/**
 * Class Role
 * @package VoceCrianca\Models
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
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'user_ids'        
    ];

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
