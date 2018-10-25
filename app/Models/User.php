<?php

namespace VoceCrianca\Models;

use Illuminate\Notifications\Notifiable;
use Jenssegers\Mongodb\Auth\User as Authenticatable;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;

/**
 * Class User
 * @package VoceCrianca
 */
class User extends Authenticatable implements JWTSubject
{

    use SoftDeletes, Notifiable;

    const VERIFIED_USER = '1';
    const UNVERIFIED_USER = '0';

    protected $verified;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'active',
        'verified',
        'roles'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'role_ids',        
    ];

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    /**
     * @param $query
     * @param $search
     * @return mixed
     */
    public function scopeWhereFullText($query, $search)
    {
        $query->getQuery()->projections = [
            'score' => [ '$meta'=>'textScore' ]
        ];

        return $query->whereRaw([
            '$text' => [ '$search' => $search ]
        ]);

    }

    /**
     * @return bool
     */
    public function isVerified()
    {
        return $this->verified == User::VERIFIED_USER;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * @return \Jenssegers\Mongodb\Relations\EmbedsMany
     */
    public function tokenResetPassword()
    {
        return $this->embedsMany(ResetPassword::class);
    }

    /**
     * @return string
     */
    public static function generateVerificationCode()
    {
        return str_random(40);
    }

    /**
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

}
