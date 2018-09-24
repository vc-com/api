<?php

namespace App\Services\Admin;

use Illuminate\Support\Facades\Validator;

/**
 * Class CategoryService
 * @package App\Services\Admin
 */
class CategoryService
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
                'name' => 'required|string|unique:categories,name,'.$id.',_id',
                'active' => 'required',
                'slug' => 'required',
            ]);

        }

        return Validator::make($data, [
            'name' => 'required|string|unique:categories|max:255',
            'active' => 'required',
            'slug' => 'required',
        ]);

    }

}
