<?php

namespace VoceCrianca\Http\Controllers\Api\V1\Admin;

use VoceCrianca\Http\Controllers\ApiController;

use VoceCrianca\Repositories\Customer\CustomerRepositoryInterface;
use VoceCrianca\Services\Admin\CustomerService;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class CustomerController extends ApiController
{

    /**
     * @var CustomerService
     */
    private $service;

    /**
     * @var CustomerRepositoryInterface
     */
    private $repository;

    /**
     * CustomerController constructor.
     * @param CustomerService $service
     * @param CustomerRepositoryInterface $repository
     */
    public function __construct(CustomerService $service,
                                CustomerRepositoryInterface $repository)
    {
        $this->service = $service;
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        if (!$result = $this->repository->all(['address', 'phones', 'questions'])) {
            return $this->errorResponse('customers_not_found', 404);
        }

        return $this->showAll($result);
    }

    /**
     *
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function store(Request $request)
    {

        $validator = $this->service->validator($request->all());

        if ($validator->fails()) {
            $errors = $validator->errors();
            return $this->errorResponse($errors->toJson(), 422);
        }

        if (!$result = $this->service->create($request)) {

            return $this->errorResponse('customer_not_created', 500);
        }

        return $this->successResponse($result, 201);

    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {

        if (!$result = $this->repository->findById($id, ['address', 'phones'])) {
            return $this->errorResponse('customer_not_found', 404);
        }

        return $this->showOne($result);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
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
            return $this->errorResponse('customer_not_found', 404);
        }

        if (!$result = $this->service->update($request, $id)) {
            return $this->errorResponse('customer_not_updated', 500);
        }

        return $this->successResponse($result);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {

        if (!$result = $this->repository->findById($id)) {
            return $this->errorResponse('customer_not_found', 404);
        }

        if (!$this->repository->delete($id)) {
            return $this->errorResponse('customer_not_removed', 500);
        }

        return $this->successResponse('customer_removed');

    }
    
}
