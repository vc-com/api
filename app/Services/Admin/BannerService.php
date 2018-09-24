<?php

namespace App\Services\Admin;

use Illuminate\Support\Facades\Validator;

/**
 * Class BannerService
 * @package App\Services\Admin
 */
class BannerService
{
    /**
     * @param array $data
     * @return mixed
     */
    public function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'active' => 'required',
            'slug' => 'required',
        ]);
    }
}
