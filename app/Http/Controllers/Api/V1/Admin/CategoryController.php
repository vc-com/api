<?php

namespace VoceCrianca\Http\Controllers\Api\V1\Admin;

use VoceCrianca\Http\Controllers\ApiController;
use VoceCrianca\Repositories\Category\CategoryRepositoryInterface;
use VoceCrianca\Services\Admin\CategoryService;
use VoceCrianca\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends ApiController
{
    /**
     * @var CategoryRepositoryInterface
     */
    private $repository;

    /**
     * @var CategoryService
     */
    private $service;

    /**
     * CategoryController constructor.
     * @param CategoryRepositoryInterface $repository
     * @param CategoryService $service
     */
    public function __construct(CategoryRepositoryInterface $repository,
                                CategoryService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {

        if (!$result = $this->repository->toArray()) {
            return $this->errorResponse('categories_not_found', 404);
        }

        return $this->showAll( tools_build_tree( $result ) );
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
            return $this->errorResponse($errors->toJson(), 422);
        }

        if (!$result = $this->repository->create($request->all())) {
            return $this->errorResponse('category_not_created', 422);
        }

        return $this->successResponse($result, 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {

        if (!$result = $this->repository->findById($id)) {
            return $this->errorResponse('category_not_found', 404);
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

        $validator = $this->service->validator($request->all(), $id);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return $this->errorResponse($errors->toJson(), 422);
        }


        if (!$result = $this->repository->findById($id)) {
            return $this->errorResponse('category_not_found', 404);
        }

        if (!$result = $this->repository->update($id, $request->all())) {
            return $this->errorResponse('category_not_updated', 500);
        }

        return $this->successResponse($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if (!$this->repository->findById($id)) {
            return $this->errorResponse('category_not_found', 404);
        }

        if (!$this->repository->delete($id)) {
            return $this->errorResponse('category_not_removed', 500);
        }

        return $this->successResponse('category_removed');

    }

}
