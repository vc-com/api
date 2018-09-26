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

        if ( isset($id) ) {

            return Validator::make($data, [
                'name' => 'required|string|unique:category_parents,name,'.$id.',_id',
                'active' => 'required',
                'slug' => 'required',
            ]);

        }

        return Validator::make($data, [
            'name' => 'required|string|unique:category_parents|max:255',
            'active' => 'required',
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

        if (!$request->has('parent_id')) {

            $data = $request->all();
            $data['parent_id'] = $id;
            $parent = $this->categoryParent->create($data);

        } else {
           $parent = $this->categoryParent->create($request->all());
        }
        
        $category = $this->category->find($id); 
        $category->parents()->attach($parent);

        return $parent;

    }

}
