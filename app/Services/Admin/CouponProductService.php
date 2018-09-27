<?php

namespace App\Services\Admin;

use Illuminate\Support\Facades\Validator;

/**
 * Class CouponProductService
 * @package App\Services\Admin
 */
class CouponProductService
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
                'name' => 'required|string|unique:coupon_products,name,'.$id.',_id',
                'active' => 'required',
                'slug' => 'required',
            ]);

        }

        return Validator::make($data, [
            'name' => 'required|string|unique:coupon_products|max:255',
            'active' => 'required',
            'slug' => 'required',
        ]);

    }
    
}
