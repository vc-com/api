<?php

namespace App\Services\Admin;

use Illuminate\Support\Facades\Validator;

/**
 * Class BrandService
 * @package App\Services\Admin
 */
class BrandService
{
    /**
     * @param array $data
     * @return mixed
     */
    public function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|unique:brands|max:255',
            'active' => 'required',
            'slug' => 'required',
        ]);
    }
}
