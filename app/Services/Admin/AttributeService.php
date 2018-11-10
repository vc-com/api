<?php

namespace VoceCrianca\Services\Admin;

use Illuminate\Support\Facades\Validator;

/**
 * Class AttributeService
 * @package VoceCrianca\Services\Admin
 */
class AttributeService
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
                'name' => 'required|string|unique:attributes,name,'.$id.',_id',
            ]);

        }

        return Validator::make($data, [
            'name' => 'required|string|unique:attributes|max:255',
        ]);

    }
    
}
