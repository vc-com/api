<?php

namespace App\Entities;

use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Role extends Model
{

    use SoftDeletes;

    const ADMIN            = 'ADMIN';
    const STAFF_AUDIT      = 'STAFF_AUDIT';
    const STAFF_SUPPORT    = 'STAFF_SUPPORT';
    const STAFF_FINANCE    = 'STAFF_FINANCE';
    const STAFF_COMMERCIAL = 'STAFF_COMMERCIAL';

    public $table = 'roles';

    protected $fillable = [
        'uuid',
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

}
