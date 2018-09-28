<?php

namespace App\Entities;

use Illuminate\Notifications\Notifiable;
use Jenssegers\Mongodb\Auth\User as Authenticatable;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;

/**
 * Class Customer
 * @package App
 */
class Customer extends Authenticatable implements JWTSubject
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
        'active',
        'verified',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
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
     * @return \Jenssegers\Mongodb\Relations\EmbedsMany
     */
    public function address()
    {
        return $this->embedsMany(CustomerAddress::class);
    }

    public function phones()
    {
        return $this->embedsMany(CustomerPhone::class);
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
