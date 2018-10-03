<?php

namespace App\Http\Controllers\Api\V1\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Entities\AttributeGroup;

class AttributeGroupController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AttributeGroup $attributeGroup)
    {
        $array = [
            ['type' => $attributeGroup::GENRE],
            ['type' => $attributeGroup::COLOR],
            ['type' => $attributeGroup::SIZE],
        ];

        return $this->showAll($array);
    }
    
}
