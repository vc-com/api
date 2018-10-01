<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\ApiController;
use App\Repositories\Coupon\CouponRepositoryInterface;
use Illuminate\Http\Request;

class CouponProductController extends ApiController
{
    
    /**
     * @var CouponRepositoryInterface
     */
    private $repository;

    /**
     * CouponProductController constructor.
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
            return $this->errorResponse('coupon_not_found', 422);
        }       

        if (!$products = $result->products()->all()) {
            return $this->errorResponse('coupon_products_not_found', 422);
        }

        return $this->showAll($products);

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
            return $this->errorResponse('coupon_not_found', 422);
        } 

        $total = $result->products()
                    ->where('product_id', $request->all()['product_id'])
                    ->count();

        if ($total !== 0 ) {
            return $this->successResponse('coupon_product_is_exists');
        }

        if (!$result = $result->products()->create($request->all())) {
            return $this->errorResponse('coupon_product_not_created', 500);
        }

        return $this->successResponse($result);

    }


    /**
     * Display the specified resource.
     *
     * @param $couponId
     * @param $productId
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($couponId, $productId)
    {

        if (!$result = $this->repository->findById($couponId)) {
            return $this->errorResponse('coupon_not_found', 422);
        }       

        if (!$phone = $result->products()->find($productId)) {
            return $this->errorResponse('coupon_product_not_found', 422);
        }

        return $this->showOne($phone);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $couponId
     * @param $productId
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $couponId, $productId)
    {
  
        if (!$result = $this->repository->findById($couponId)) {
            return $this->errorResponse('coupon_not_found', 422);
        }  

        $total = $result->products()
                        ->where('_id', '!=', $productId)
                        ->where('product_id', $request->all()['product_id'])
                        ->count();

        if ($total !== 0 ) {
            return $this->successResponse('coupon_product_is_exists');
        }

        if (!$result = $result->products()->find($productId)->update($request->all())) {
            return $this->errorResponse('coupon_product_not_updated', 422);
        }

        return $this->successResponse($result);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $couponId
     * @param $productId
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($couponId, $productId)
    {

        if (!$result = $this->repository->findById($couponId)) {
            return $this->errorResponse('coupon_not_found', 422);
        }       

        if (!$result->products()->destroy($productId)) {
            return $this->errorResponse('coupon_product_not_removed', 422);
        }

        return $this->successResponse('coupon_product_removed');

    }

}
