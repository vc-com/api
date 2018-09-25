<?php

namespace App\Services\Admin;

use App\Entities\Category;
use App\Repositories\CategoryParent\CategoryParentRepositoryInterface;
use Illuminate\Support\Facades\Validator;

/**
 * Class CategoryParentService
 * @package App\Services\Admin
 */
class CategoryParentService
{
    /**
     * @var CategoryParentRepositoryInterface
     */
    private $repository;

    /**
     * CategoryParentService constructor.
     * @param CategoryParentRepositoryInterface $repository
     */
    public function __construct(CategoryParentRepositoryInterface $repository)
    {

        $this->repository = $repository;
    }

    /**
     * @param array $data
     * @param string $id
     * @return mixed
     */
    public function validator(array $data, $id='')
    {

        if ( isset($id) ) {

            return Validator::make($data, [
                'name' => 'required|string|unique:categories_parents,name,'.$id.',_id',
                'active' => 'required',
                'slug' => 'required',
            ]);

        }

        return Validator::make($data, [
            'name' => 'required|string|unique:categories_parents|max:255',
            'active' => 'required',
            'slug' => 'required',
        ]);

    }

}
