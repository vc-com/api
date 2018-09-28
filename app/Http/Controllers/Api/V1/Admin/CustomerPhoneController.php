<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\ApiController;
use App\Repositories\Customer\CustomerRepositoryInterface;
use Illuminate\Http\Request;

class CustomerPhoneController extends ApiController
{
    
    /**
     * @var CustomerRepositoryInterface
     */
    private $repository;

    /**
     * CustomerPhoneController constructor.
     * @param CustomerRepositoryInterface $repository
     */
    public function __construct(CustomerRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param $customerId
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($customerId)
    {

        if (!$result = $this->repository->findById($customerId)) {
            return $this->errorResponse('customer_not_found', 422);
        }       

        if (!$phones = $result->phones()->all()) {
            return $this->errorResponse('customer_phones_not_found', 422);
        }

        return $this->showAll($phones);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param $customerId
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, $customerId)
    {

        if (!$result = $this->repository->findById($customerId)) {
            return $this->errorResponse('customer_not_found', 422);
        } 

        $total = $result->phones()
                    ->where('number', $request->all()['number'])
                    ->count();

        if ($total !== 0 ) {
            return $this->successResponse('customer_phone_is_exists');
        }

        if (!$result = $result->phones()->create($request->all())) {
            return $this->errorResponse('customer_phone_not_created', 500);
        }

        return $this->successResponse($result);

    }


    /**
     * Display the specified resource.
     *
     * @param $customerId
     * @param $phoneId
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($customerId, $phoneId)
    {

        if (!$result = $this->repository->findById($customerId)) {
            return $this->errorResponse('customer_not_found', 422);
        }       

        if (!$phone = $result->phones()->find($phoneId)) {
            return $this->errorResponse('customer_phone_not_found', 422);
        }

        return $this->showOne($phone);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $customerId
     * @param $phoneId
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $customerId, $phoneId)
    {
  
        if (!$result = $this->repository->findById($customerId)) {
            return $this->errorResponse('customer_not_found', 422);
        }  

        $total = $result->phones()
                        ->where('_id', '!=', $phoneId)
                        ->where('number', $request->all()['number'])
                        ->count();

        if ($total !== 0 ) {
            return $this->successResponse('customer_phone_is_exists');
        }

        if (!$result = $result->phones()->find($phoneId)->update($request->all())) {
            return $this->errorResponse('customer_phone_not_updated', 422);
        }

        return $this->successResponse($result);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $customerId
     * @param $phoneId
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($customerId, $phoneId)
    {

        if (!$result = $this->repository->findById($customerId)) {
            return $this->errorResponse('customer_not_found', 422);
        }       

        if (!$phone = $result->phones()->destroy($phoneId)) {
            return $this->errorResponse('customer_phone_not_removed', 422);
        }

        return $this->successResponse('customer_phone_removed');

    }

}
