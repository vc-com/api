<?php

namespace VoceCrianca\Services\Admin;

use Illuminate\Support\Facades\Validator;

/**
 * Class PageService
 * @package VoceCrianca\Services\Admin
 */
class PageService
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
                'name' => 'required|string|unique:pages,name,'.$id.',_id',
                //'slug' => 'required',
                'active' => 'required',
                'description' => 'required',
                'slug' => 'required',
                'meta_title' => 'required',
                'meta_description' => 'required',
            ]);

        }

        return Validator::make($data, [
            'name' => 'required|string|unique:pages|max:255',
            //'slug' => 'required',
            'active' => 'required',
            'description' => 'required',
            'slug' => 'required',
            'meta_title' => 'required',
            'meta_description' => 'required',
        ]);

    }

}
