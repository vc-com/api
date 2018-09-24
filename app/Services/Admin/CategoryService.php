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
     * @return mixed
     */
    public function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|unique:categories|max:255',
            'active' => 'required',
            'slug' => 'required',
         ]);
    }
}

