<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\ApiController;
use App\Repositories\Customer\CustomerRepositoryInterface;
use App\Repositories\CustomerAddress\CustomerAddressRepositoryInterface;
use App\Services\Admin\CustomerAddressService;
use Illuminate\Http\Request;

class CustomerAddressController extends ApiController
{
    /**
     * @var CustomerRepositoryInterface
     */
    private $customerRepository;

    /**
     * @var CustomerAddressRepositoryInterface
     */
    private $addressRepository;

    /**
     * @var CustomerAddressService
     */
    private $addressService;


    /**
     * CustomerAddressController constructor.
     * @param CustomerRepositoryInterface $customerRepository
     * @param CustomerAddressRepositoryInterface $addressRepository
     * @param CustomerAddressService $addressService
     */
    public function __construct(CustomerRepositoryInterface $customerRepository,
                                CustomerAddressRepositoryInterface $addressRepository,
                                CustomerAddressService $addressService)
    {
        $this->customerRepository = $customerRepository;
        $this->addressRepository = $addressRepository;
        $this->addressService = $addressService;
    }

    /**
     * Exists Customer
     *
     * @param $customerId
     * @return bool
     */
    private function isExistsCustomer($customerId)
    {

        if (!$result = $this->customerRepository->findById($customerId)) {
            return false;
        }

        return true;

    }

    /**
     * Display a listing of the resource.
     *
     * @param $customerId
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($customerId)
    {

        if (!$result = $this->customerRepository->findById($customerId, ['address'])) {
            return $this->errorResponse('address_not_found', 422);
        }

        return $this->showAll($result);
        
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

        $validator = $this->addressService->validator($request->all());

        if ($validator->fails()) {
            $errors = $validator->errors();
            return $errors->toJson();
        }

        if (!$result = $this->addressService->create($request, $customerId)) {
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

        if (!$this->isExistsCustomer($customerId) ) {
            return $this->errorResponse('customer_not_found', 422);
        }

        if (!$result = $this->addressRepository->findById($addressId)) {
            return $this->errorResponse('customer_address_not_found', 422);
        }

        return $this->showOne($result);

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

        $validator = $this->addressService->validator($request->all(), $addressId);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return $errors->toJson();
        }

        if (!$this->isExistsCustomer($customerId) ) {
            return $this->errorResponse('customer_not_found', 422);
        }


        if (!$result = $this->addressRepository->findById($addressId)) {
            return $this->errorResponse('customer_address_not_found', 422);
        }

        if (!$result = $this->addressRepository->update($addressId, $request->all())) {
            return $this->errorResponse('customer_address_not_updated', 422);
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

        if (!$this->isExistsCustomer($customerId) ) {
            return $this->errorResponse('customer_not_found', 422);
        }

        if (!$this->addressRepository->delete($addressId)) {
            return $this->errorResponse('customer_address_not_removed', 422);
        }

        return $this->successResponse('customer_address_removed');

    }

}
