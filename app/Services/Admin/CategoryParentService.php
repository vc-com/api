<?php

namespace App\Services\Admin;

use Illuminate\Support\Facades\Validator;

/**
 * Class CategoryParentService
 * @package App\Services\Admin
 */
class CategoryParentService
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
                'parent_id' => 'required',
                'name' => 'required|string|unique:category_parents,name,'.$id.',_id',
                'active' => 'required',
                'slug' => 'required',
            ]);

        }

        return Validator::make($data, [
            'parent_id' => 'required',
            'name' => 'required|string|unique:category_parents|max:255',
            'active' => 'required',
            'slug' => 'required',
        ]);

    }

}
