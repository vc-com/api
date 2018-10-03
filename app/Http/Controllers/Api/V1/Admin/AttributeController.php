<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\ApiController;
use App\Repositories\Attribute\AttributeRepositoryInterface;
use App\Services\Admin\AttributeService;
use Illuminate\Http\Request;

class AttributeController extends ApiController
{
    /**
     * @var AttributeRepositoryInterface
     */
    private $repository;

    /**
     * @var AttributeService
     */
    private $service;

    /**
     * AttributeController constructor.
     * @param AttributeRepositoryInterface $repository
     * @param AttributeService $service
     */
    public function __construct(AttributeRepositoryInterface $repository,
                                AttributeService $service)
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

        if (!$result = $this->repository->all()) {
            return $this->errorResponse('attributes_not_found', 422);
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
            return $this->errorResponse('attribute_not_created', 422);
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
            return $this->errorResponse('attribute_not_found', 422);
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
            return $this->errorResponse('attribute_not_found', 422);
        }

        if (!$result = $this->repository->update($id, $request->all())) {
            return $this->errorResponse('attribute_not_updated', 422);
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
            return $this->errorResponse('attribute_not_found', 422);
        }

        if (!$this->repository->delete($id)) {
            return $this->errorResponse('attribute_not_removed', 422);
        }

        return $this->successResponse('attribute_removed');

    }

}