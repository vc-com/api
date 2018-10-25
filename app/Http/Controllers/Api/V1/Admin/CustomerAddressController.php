<?php

namespace VoceCrianca\Http\Controllers\Api\V1\Admin;

use VoceCrianca\Http\Controllers\ApiController;
use VoceCrianca\Repositories\Customer\CustomerRepositoryInterface;
use Illuminate\Http\Request;

class CustomerAddressController extends ApiController
{
    
    /**
     * @var CustomerRepositoryInterface
     */
    private $repository;

    /**
     * CustomerAddressController constructor.
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
            return $this->errorResponse('customer_not_found', 404);
        }       

        if (!$address = $result->address()->all()) {
            return $this->errorResponse('customer_address_not_found', 404);
        }

        return $this->showAll($address);

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
            return $this->errorResponse('customer_not_found', 404);
        } 

        $total = $result->address()
                    ->where('address', $request->all()['address'])
                    ->where('postcode', $request->all()['postcode'])
                    ->count();

        if ($total !== 0 ) {
            return $this->successResponse('customer_address_is_exists');
        }

        if (!$result = $result->address()->create($request->all())) {
            return $this->errorResponse('customer_address_not_created', 500);
        }

        return $this->successResponse($result);

    }


    /**
     * Display the specified resource.
     *
     * @param $customerId
     * @param $addressId
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($customerId, $addressId)
    {

        if (!$result = $this->repository->findById($customerId)) {
            return $this->errorResponse('customer_not_found', 404);
        }       

        if (!$phone = $result->address()->find($addressId)) {
            return $this->errorResponse('customer_address_not_found', 404);
        }

        return $this->showOne($phone);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $customerId
     * @param $addressId
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $customerId, $addressId)
    {
  
        if (!$result = $this->repository->findById($customerId)) {
            return $this->errorResponse('customer_not_found', 404);
        }  

        $total = $result->address()
                        ->where('_id', '!=', $addressId)
                        ->where('address', $request->all()['address'])
                        ->where('postcode', $request->all()['postcode'])
                        ->count();

        if ($total !== 0 ) {
            return $this->successResponse('customer_address_is_exists');
        }

        if (!$result = $result->address()->find($addressId)->update($request->all())) {
            return $this->errorResponse('customer_address_not_updated', 500);
        }

        return $this->successResponse($result);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $customerId
     * @param $addressId
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($customerId, $addressId)
    {

        if (!$result = $this->repository->findById($customerId)) {
            return $this->errorResponse('customer_not_found', 404);
        }       

        if (!$result->address()->destroy($addressId)) {
            return $this->errorResponse('customer_address_not_removed', 500);
        }

        return $this->successResponse('customer_address_removed');

    }

}
