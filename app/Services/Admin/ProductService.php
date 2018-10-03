<?php

namespace App\Services\Admin;

use Illuminate\Support\Facades\Validator;

/**
 * Class ProductService
 * @package App\Services\Admin
 */
class ProductService
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
                'name' => 'required|string|unique:products,name,'.$id.',_id',
                'slug' => 'required|string|unique:products,slug,'.$id.',_id',
            ]);

        }

        return Validator::make($data, [
            'name' => 'required|string|unique:products|max:255',
            'slug' => 'required|string|unique:products|max:255',
        ]);

    }
    
}
