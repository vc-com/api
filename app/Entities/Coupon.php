<?php

namespace App\Entities;

use Jenssegers\Mongodb\Eloquent\Model;

class Coupon extends Model
{

    const FREE_SHIPPING = "free_shipping";
    const PERCENTAGE = "percentage";
    const FIXED = "fixed";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'active',
        'name',
        'code',
        'description',
        'type',
        'discount',
        'uses_total',
        'uses_customer',
        'value',
        'minimum_value',
        'quantities',
        'apply_to_total',
        'cumulative',
        'quantity_by_customer',
        'used_total',
        'date_start',
        'date_end',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * @return \Jenssegers\Mongodb\Relations\EmbedsMany
     */
    public function categories()
    {
        return $this->embedsMany(CouponCategory::class);
    }

    /**
     * @return \Jenssegers\Mongodb\Relations\EmbedsMany
     */
    public function histories()
    {
        return $this->embedsMany(CouponHistory::class);
    }

    /**
     * @return \Jenssegers\Mongodb\Relations\EmbedsMany
     */
    public function products()
    {
        return $this->embedsMany(CouponProduct::class);
    }

    
}
