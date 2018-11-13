<?php

namespace VoceCrianca\Services\Admin\Catalog;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

/**
 * Class PageService
 * @package VoceCrianca\Services\Admin\Catalog
 */
class PageService
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
                'name' => 'required|string|unique:pages,name,'.$id.',_id',
                'active' => 'required|boolean',
                'description' => 'required',
                'slug' => 'required|string|max:255'
            ]);

        }

        return Validator::make($request->all(), [
            'name' => 'required|string|unique:pages|max:255',
            'active' => 'required|boolean',
            'description' => 'required',
            'slug' => 'required|string|max:255'
        ]);

    }

}
