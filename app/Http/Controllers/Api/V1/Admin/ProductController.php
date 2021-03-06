<?php

namespace VoceCrianca\Http\Controllers\Api\V1\Admin;

use VoceCrianca\Repositories\Product\ProductRepositoryInterface;
use VoceCrianca\Services\Admin\ProductService;
use Illuminate\Http\Request;
use VoceCrianca\Http\Controllers\ApiController;

class ProductController extends ApiController
{

    /**
     * @var ProductRepositoryInterface
     */
    private $repository;

    /**
     * @var ProductService
     */
    private $service;

    /**
     * ProductController constructor.
     * @param ProductRepositoryInterface $repository
     * @param ProductService $service
     */
    public function __construct(ProductRepositoryInterface $repository,
                                ProductService $service)
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

        // if (!$result = $this->repository->getFieldsAll()) {
        //     return $this->errorResponse('products_not_found', 404);
        // }

        if (!$result = $this->repository->all(['questions'])) {
            return $this->errorResponse('products_not_found', 404);
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
            return $this->errorResponse($errors->toJson(), 422);
        }

        if (!$result = $this->repository->create($request->all())) {
            return $this->errorResponse('product_not_created', 422);
        }

        return $this->successResponse($result);

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
            return $this->errorResponse('product_not_found', 404);
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
            return $this->errorResponse('product_not_found', 404);
        }

        if (!$result = $this->repository->update($id, $request->all())) {
            return $this->errorResponse('product_not_updated', 500);
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
            return $this->errorResponse('product_not_found', 404);
        }

        if (!$this->repository->delete($id)) {
            return $this->errorResponse('product_not_removed', 500);
        }

        return $this->successResponse('product_removed');
    }

}
