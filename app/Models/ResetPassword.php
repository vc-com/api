<?php

namespace VoceCrianca\Models;

use Jenssegers\Mongodb\Eloquent\Model;

/**
 * Class ResetPassword
 * @package VoceCrianca\Models
 */
class ResetPassword extends Model
{

    protected $fillable = [
        'token',
        'time',
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
    ];
}
