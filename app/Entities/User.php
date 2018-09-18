<?php

namespace App\Entities;

use Illuminate\Notifications\Notifiable;
use Jenssegers\Mongodb\Auth\User as Authenticatable;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

/**
 * Class User
 * @package App
 */
class User extends Authenticatable implements JWTSubject
{

    use SoftDeletes, Notifiable;

    const VERIFIED_USER = '1';
    const UNVERIFIED_USER = '0';

    protected $admin;
    protected $verified;


    /**
     * @var string
     */
    public $table = 'users';

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
        'roles',
        'privileges',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function scopeWhereFullText($query, $search)
    {
        $query->getQuery()->projections = [
            'score' => [ '$meta'=>'textScore' ]
        ];

        return $query->whereRaw([
            '$text' => [ '$search' => $search ]
        ]);

    }

    public function isVerified()
    {
        return $this->verified == User::VERIFIED_USER;
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function privileges()
    {
        return $this->embedsMany(Privilege::class);
    }

    public static function generateVerificationCode()
    {
        return str_random(40);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

}
