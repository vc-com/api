<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\ApiController;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Services\Admin\CategoryParentService;
use Illuminate\Http\Request;

class CategoryParentController extends ApiController
{
    /**
     * @var CategoryRepositoryInterface
     */
    private $repository;

    /**
     * @var CategoryParentService
     */
    private $service;


    /**
     * CategoryParentController constructor.
     * @param CategoryRepositoryInterface $repository
     * @param CategoryParentService $service
     */
    public function __construct(CategoryRepositoryInterface $repository,
                                CategoryParentService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }


    /**
     * Display a listing of the resource.
     *
     * @param $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($category)
    {
        if (!$result = $this->repository->findById($category, ['parents'])) {
            return $this->errorResponse('categories_not_found', 422);
        }

        return $this->showAll($result);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {

        $validator = $this->service->validator($request->all());

        if ($validator->fails()) {
            $errors = $validator->errors();
            return $errors->toJson();
        }

        if (!$result = $this->repository->create($request->all())) {
            return $this->errorResponse('category_not_created', 422);
        }

        return $this->successResponse($result);

    }

    /**
     * Display the specified resource.
     *
     * @param $category
     * @param $parent
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($category, $parent)
    {

        if (!$result = $this->service->getById($category, $parent)) {
            return $this->errorResponse('category_not_found', 422);
        }

        return $this->showOne($result);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {

        $validator = $this->service->validator($request->all());

        if ($validator->fails()) {
            $errors = $validator->errors();
            return $errors->toJson();
        }


        if (!$result = $this->repository->findById($id)) {
            return $this->errorResponse('category_not_found', 422);
        }

        if (!$result = $this->repository->update($id, $request->all())) {
            return $this->errorResponse('category_not_updated', 422);
        }

        return $this->successResponse($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $category
     * @param $parent
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($category, $parent)
    {


        if (!$result = $this->service->getById($category, $parent)) {
            return $this->errorResponse('category_not_found', 422);
        }


        if (!$result = $this->service->delete($parent)) {
            return $this->errorResponse('category_not_removed', 422);
        }

        return $this->successResponse('category_removed');

    }

}