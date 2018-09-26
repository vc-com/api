<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\ApiController;
use App\Repositories\Customer\CustomerRepositoryInterface;
use App\Repositories\CustomerPhone\CustomerPhoneRepositoryInterface;
use App\Services\Admin\CustomerPhoneService;
use Illuminate\Http\Request;

class CustomerPhoneController extends ApiController
{
    /**
     * @var CustomerRepositoryInterface
     */
    private $customerRepository;

    /**
     * @var CustomerPhoneRepositoryInterface
     */
    private $phoneRepository;

    /**
     * @var CustomerPhoneService
     */
    private $phoneService;


    /**
     * CustomerPhoneController constructor.
     * @param CustomerRepositoryInterface $customerRepository
     * @param CustomerPhoneRepositoryInterface $phoneRepository
     * @param CustomerPhoneService $phoneService
     */
    public function __construct(CustomerRepositoryInterface $customerRepository,
                                CustomerPhoneRepositoryInterface $phoneRepository,
                                CustomerPhoneService $phoneService)
    {
        $this->customerRepository = $customerRepository;
        $this->phoneRepository = $phoneRepository;
        $this->phoneService = $phoneService;
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
        if (!$result = $this->customerRepository->findById($customerId, ['phones'])) {
            return $this->errorResponse('phone_not_found', 422);
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

        $validator = $this->phoneService->validator($request->all());

        if ($validator->fails()) {
            $errors = $validator->errors();
            return $errors->toJson();
        }

        if (!$result = $this->phoneService->create($request, $customerId)) {
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

        if (!$this->isExistsCustomer($customerId) ) {
            return $this->errorResponse('customer_not_found', 422);
        }

        if (!$result = $this->phoneRepository->findById($phoneId)) {
            return $this->errorResponse('customer_phone_not_found', 422);
        }

        return $this->showOne($result);

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

        $validator = $this->phoneService->validator($request->all(), $phoneId);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return $errors->toJson();
        }

        if (!$this->isExistsCustomer($customerId) ) {
            return $this->errorResponse('customer_not_found', 422);
        }


        if (!$result = $this->phoneRepository->findById($phoneId)) {
            return $this->errorResponse('customer_phone_not_found', 422);
        }

        if (!$result = $this->phoneRepository->update($phoneId, $request->all())) {
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

        if (!$this->isExistsCustomer($customerId) ) {
            return $this->errorResponse('customer_not_found', 422);
        }

        if (!$this->phoneRepository->delete($phoneId)) {
            return $this->errorResponse('customer_phone_not_removed', 422);
        }

        return $this->successResponse('customer_phone_removed');

    }

}
