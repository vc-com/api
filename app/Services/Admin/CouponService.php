<?php

namespace App\Services\Admin;

use Illuminate\Support\Facades\Validator;

/**
 * Class CouponService
 * @package App\Services\Admin
 */
class CouponService
{

    /**
     * @param array $data
     * @param string $id
     * @return mixed
     */
    public function validator(array $data, $id='')
    {

        if ( isset($id) ) {

            return Validator::make($data, [
                'name' => 'required|string|unique:coupons,name,'.$id.',_id',
                'active' => 'required',
                'slug' => 'required',
            ]);

        }

        return Validator::make($data, [
            'name' => 'required|string|unique:coupons|max:255',
            'active' => 'required',
            'slug' => 'required',
        ]);

    }
    
}
