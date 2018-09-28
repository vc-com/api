<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\ApiController;
use App\Repositories\Category\CategoryRepositoryInterface;
use Illuminate\Http\Request;

class CategoryParentController extends ApiController
{

    /**
     * @var CategoryRepositoryInterface
     */
    private $repository;

    /**
     * CategoryParentController constructor.
     * @param CategoryRepositoryInterface $repository
     */
    public function __construct(CategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param $categoryId
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($categoryId)
    {

        if (!$result = $this->repository->findById($categoryId)) {
            return $this->errorResponse('category_not_found', 422);
        }       

        if (!$parents = $result->parents()->all()) {
            return $this->errorResponse('category_parents_not_found', 422);
        }

        return $this->showAll($parents);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param $categoryId
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, $categoryId)
    {

        if (!$result = $this->repository->findById($categoryId)) {
            return $this->errorResponse('category_not_found', 422);
        } 

        $total = $result->parents()
                    ->where('name', $request->all()['name'])
                    ->count();

        if ($total !== 0 ) {
            return $this->successResponse('category_parent_is_exists');
        }

        if (!$result = $result->parents()->create($request->all())) {
            return $this->errorResponse('category_parent_not_created', 500);
        }

        return $this->successResponse($result);

    }

    /**
     * Display the specified resource.
     *
     * @param $categoryId
     * @param $parentId
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($categoryId, $parentId)
    {

        if (!$result = $this->repository->findById($categoryId)) {
            return $this->errorResponse('category_not_found', 422);
        }       

        if (!$parents = $result->parents()->find($parentId)) {
            return $this->errorResponse('category_parent_not_found', 422);
        }

        return $this->showOne($parents);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $categoryId
     * @param $parentId
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $categoryId, $parentId)
    {

        if (!$result = $this->repository->findById($categoryId)) {
            return $this->errorResponse('category_not_found', 422);
        }  

        $total = $result->parents()
                        ->where('_id', '!=', $parentId)
                        ->where('name', $request->all()['name'])
                        ->count();

        if ($total !== 0 ) {
            return $this->successResponse('category_parent_is_exists');
        }

        if (!$result = $result->parents()->find($parentId)->update($request->all())) {
            return $this->errorResponse('category_parent_not_updated', 422);
        }

        return $this->successResponse($result);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $categoryId
     * @param $parentId
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($categoryId, $parentId)
    {

        if (!$result = $this->repository->findById($categoryId)) {
            return $this->errorResponse('category_not_found', 422);
        }       

        if (!$result->parents()->destroy($parentId)) {
            return $this->errorResponse('category_parent_not_removed', 422);
        }

        return $this->successResponse('category_parent_removed');

    }

}