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
     * @param $customer
     * @return bool
     */
    private function isExistsCustomer($customer)
    {


        if (!$result = $this->customerRepository->findById($customer)) {
            return false;
        }

        return true;

    }

    /**
     * Display a listing of the resource.
     *
     * @param $customer
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($customer)
    {
        if (!$result = $this->customerRepository->findById($customer, ['address'])) {
            return $this->errorResponse('address_not_found', 422);
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
            return $errors->toJson();
        }

        if (!$result = $this->service->create($request)) {

            return $this->errorResponse('customer_address_not_created', 500);
        } 


    }


    /**
     * Display the specified resource.
     *
     * @param $customer
     * @param $address
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($customer, $address)
    {

        if (!$this->isExistsCustomer($customer) ) {
            return $this->errorResponse('customer_not_found', 422);
        }

        if (!$result = $this->addressRepository->findById($address)) {
            return $this->errorResponse('customer_address_not_found', 422);
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
            return $errors->toJson();
        }


        if (!$result = $this->repository->findById($id)) {
            return $this->errorResponse('customer_address_not_found', 422);
        }

        if (!$result = $this->service->update($request, $id)) {
            return $this->errorResponse('customer_address_not_updated', 422);
        }

        return $this->successResponse($result);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $customer
     * @param $address
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($customer, $address)
    {

        if (!$this->isExistsCustomer($customer) ) {
            return $this->errorResponse('customer_not_found', 422);
        }

        if (!$this->addressRepository->delete($address)) {
            return $this->errorResponse('customer_address_not_removed', 422);
        }

        return $this->successResponse('customer_address_removed');

    }

}
