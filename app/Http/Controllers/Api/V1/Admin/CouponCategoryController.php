<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\ApiController;
use App\Repositories\Coupon\CouponRepositoryInterface;
use Illuminate\Http\Request;

class CouponCategoryController extends ApiController
{
    
    /**
     * @var CouponRepositoryInterface
     */
    private $repository;

    /**
     * CouponCategoryController constructor.
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

        if (!$categories = $result->categories()->all()) {
            return $this->errorResponse('coupon_categories_not_found', 422);
        }

        return $this->showAll($categories);

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

        $total = $result->categories()
                    ->where('category_id', $request->all()['category_id'])
                    ->count();

        if ($total !== 0 ) {
            return $this->successResponse('coupon_category_is_exists');
        }

        if (!$result = $result->categories()->create($request->all())) {
            return $this->errorResponse('coupon_category_not_created', 500);
        }

        return $this->successResponse($result);

    }


    /**
     * Display the specified resource.
     *
     * @param $couponId
     * @param $categoryId
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($couponId, $categoryId)
    {

        if (!$result = $this->repository->findById($couponId)) {
            return $this->errorResponse('coupon_not_found', 422);
        }       

        if (!$phone = $result->categories()->find($categoryId)) {
            return $this->errorResponse('coupon_category_not_found', 422);
        }

        return $this->showOne($phone);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $couponId
     * @param $categoryId
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $couponId, $categoryId)
    {
  
        if (!$result = $this->repository->findById($couponId)) {
            return $this->errorResponse('coupon_not_found', 422);
        }  

        $total = $result->categories()
                        ->where('_id', '!=', $categoryId)
                        ->where('category_id', $request->all()['category_id'])
                        ->count();

        if ($total !== 0 ) {
            return $this->successResponse('coupon_category_is_exists');
        }

        if (!$result = $result->categories()->find($categoryId)->update($request->all())) {
            return $this->errorResponse('coupon_category_not_updated', 422);
        }

        return $this->successResponse($result);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $couponId
     * @param $categoryId
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($couponId, $categoryId)
    {

        if (!$result = $this->repository->findById($couponId)) {
            return $this->errorResponse('coupon_not_found', 422);
        }       

        if (!$result->categories()->destroy($categoryId)) {
            return $this->errorResponse('coupon_category_not_removed', 422);
        }

        return $this->successResponse('coupon_category_removed');

    }

}
