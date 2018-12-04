<?php

namespace VoceCrianca\Services\Admin\Catalog;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

/**
 * Class BrandService
 * @package VoceCrianca\Services\Admin\Catalog
 */
class BrandService
{

    public function validator(Request $request, $id='')
    {
        if ( isset($id) ) {

             if ($request->input('action') ==="edit-status") {
                return Validator::make($request->all(), [
                    'active' => 'required|boolean'
                ]);
            }

            return Validator::make($request->all(), [
                'name' => 'required|string|unique:brands,name,'.$id.',_id',
                'active' => 'required',
                'slug' => 'required',
            ]);

        }

        return Validator::make($request->all(), [
            'name' => 'required|string|unique:brands|max:255',
            'active' => 'required',
            'slug' => 'required',
        ]);

    }

}
