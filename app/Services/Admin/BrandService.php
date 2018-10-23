<?php

namespace VoceCrianca\Services\Admin;

use Illuminate\Support\Facades\Validator;

/**
 * Class BrandService
 * @package VoceCrianca\Services\Admin
 */
class BrandService
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
                'name' => 'required|string|unique:brands,name,'.$id.',_id',
                'active' => 'required',
                'slug' => 'required',
            ]);

        }

        return Validator::make($data, [
            'name' => 'required|string|unique:brands|max:255',
            'active' => 'required',
            'slug' => 'required',
        ]);

    }

}
