<?php

namespace VoceCrianca\Http\Controllers\Api\V1\Admin;

use VoceCrianca\Http\Controllers\ApiController;
use VoceCrianca\Repositories\Coupon\CouponRepositoryInterface;
use Illuminate\Http\Request;

class CouponHistoryController extends ApiController
{
    
    /**
     * @var CouponRepositoryInterface
     */
    private $repository;

    /**
     * CouponHistoryController constructor.
     * @param CouponRepositoryInterface $repository
     */
    public function __construct(CouponRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param $couponId
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($couponId)
    {

        if (!$result = $this->repository->findById($couponId)) {
            return $this->errorResponse('coupon_not_found', 404);
        }       

        if (!$histories = $result->histories()->all()) {
            return $this->errorResponse('coupon_histories_not_found', 404);
        }

        return $this->showAll($histories);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param $couponId
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, $couponId)
    {

        if (!$result = $this->repository->findById($couponId)) {
            return $this->errorResponse('coupon_not_found', 404);
        } 

        $total = $result->histories()
                    ->where('order_id', $request->all()['order_id'])
                    ->where('customer_id', $request->all()['customer_id'])
                    ->count();

        if ($total !== 0 ) {
            return $this->successResponse('coupon_history_is_exists');
        }

        if (!$result = $result->histories()->create($request->all())) {
            return $this->errorResponse('coupon_history_not_created', 500);
        }

        return $this->successResponse($result);

    }


    /**
     * Display the specified resource.
     *
     * @param $couponId
     * @param $historyId
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($couponId, $historyId)
    {

        if (!$result = $this->repository->findById($couponId)) {
            return $this->errorResponse('coupon_not_found', 404);
        }       

        if (!$phone = $result->histories()->find($historyId)) {
            return $this->errorResponse('coupon_history_not_found', 404);
        }

        return $this->showOne($phone);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $couponId
     * @param $historyId
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $couponId, $historyId)
    {
  
        if (!$result = $this->repository->findById($couponId)) {
            return $this->errorResponse('coupon_not_found', 404);
        }  

        $total = $result->histories()
                        ->where('_id', '!=', $historyId)
                        ->where('order_id', $request->all()['order_id'])
                        ->where('customer_id', $request->all()['customer_id'])
                        ->count();

        if ($total !== 0 ) {
            return $this->successResponse('coupon_history_is_exists');
        }

        if (!$result = $result->histories()->find($historyId)->update($request->all())) {
            return $this->errorResponse('coupon_history_not_updated', 500);
        }

        return $this->successResponse($result);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $couponId
     * @param $historyId
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($couponId, $historyId)
    {

        if (!$result = $this->repository->findById($couponId)) {
            return $this->errorResponse('coupon_not_found', 404);
        }       

        if (!$result->histories()->destroy($historyId)) {
            return $this->errorResponse('coupon_history_not_removed', 500);
        }

        return $this->successResponse('coupon_history_removed');

    }

}
