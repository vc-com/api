<?php

namespace VoceCrianca\Services\Admin;

use Illuminate\Support\Facades\Validator;

/**
 * Class BannerService
 * @package VoceCrianca\Services\Admin
 */
class BannerService
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
                'name' => 'required|string|unique:banners,name,'.$id.',_id',
                'active' => 'required',
                'slug' => 'required',
            ]);

        }

        return Validator::make($data, [
            'name' => 'required|string|unique:banners|max:255',
            'active' => 'required',
            'slug' => 'required',
        ]);

    }
    
}
