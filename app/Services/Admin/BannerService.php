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
     * @param string $id
     * @return mixed
     */
    public function validator(array $data, $id='')
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
        ]);
    }
}
