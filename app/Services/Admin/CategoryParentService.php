<?php

namespace App\Services\Admin;

use App\Entities\Category;
use App\Entities\CategoryParent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Class CategoryParentService
 * @package App\Services\Admin
 */
class CategoryParentService
{
    /**
     * @var Category
     */
    private $category;

    /**
     * @var CategoryParent
     */
    private $categoryParent;

    /**
     * CategoryParentService constructor.
     * @param Category $category
     * @param CategoryParent $categoryParent
     */
    public function __construct(Category $category, CategoryParent $categoryParent)
    {
        $this->category = $category;
        $this->categoryParent = $categoryParent;
    }

    /**
     * @param array $data
     * @param string $id
     * @return mixed
     */
    public function validator(array $data, $id='')
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'active' => 'required',
            'nleft' => 'required|integer',
            'slug' => 'required',
        ]);

    }

    /**
     * Create And Attach
     *
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function create(Request $request, $id)
    {

        $category = $this->category->find($id);

        $exists = $category->parents()
                ->where('name', $request->input('name') )
                ->exists();

        if ($exists === true) {
            return $category->parents()
                ->where('name', $request->input('name') )
                ->first();
        }

        $parent = $this->categoryParent->create($request->all());
        $category->parents()->attach($parent);

        return $parent;

    }

}
