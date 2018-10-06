<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\ApiController;
use App\Repositories\Product\ProductRepositoryInterface;
use Illuminate\Http\Request;

class ProductRelatedController extends ApiController
{
    
    /**
     * @var ProductRepositoryInterface
     */
    private $repository;

    /**
     * ProductRelatedController constructor.
     * @param ProductRepositoryInterface $repository
     */
    public function __construct(ProductRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param $productId
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($productId)
    {

        if (!$result = $this->repository->findById($productId)) {
            return $this->errorResponse('product_not_found', 422);
        }       

        if (!$relateds = $result->relateds()->all()) {
            return $this->errorResponse('product_relateds_not_found', 422);
        }

        return $this->showAll($relateds);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param $productId
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, $productId)
    {

        if (!$result = $this->repository->findById($productId)) {
            return $this->errorResponse('product_not_found', 422);
        } 

        $total = $result->relateds()
                    ->where('related_id', $request->all()['related_id'])
                    ->count();

        if ($total !== 0 ) {
            return $this->successResponse('product_related_is_exists');
        }

        if (!$result = $result->relateds()->create($request->all())) {
            return $this->errorResponse('product_related_not_created', 500);
        }

        return $this->successResponse($result);

    }


    /**
     * Display the specified resource.
     *
     * @param $productId
     * @param $relatedId
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($productId, $relatedId)
    {

        if (!$result = $this->repository->findById($productId)) {
            return $this->errorResponse('product_not_found', 422);
        }       

        if (!$related = $result->relateds()->find($relatedId)) {
            return $this->errorResponse('product_related_not_found', 422);
        }

        return $this->showOne($related);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $productId
     * @param $relatedId
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $productId, $relatedId)
    {
  
        if (!$result = $this->repository->findById($productId)) {
            return $this->errorResponse('product_not_found', 422);
        }  

        $total = $result->relateds()
                        ->where('_id', '!=', $relatedId)
                        ->where('related_id', $request->all()['related_id'])
                        ->count();

        if ($total !== 0 ) {
            return $this->successResponse('product_related_is_exists');
        }

        if (!$result = $result->relateds()->find($relatedId)->update($request->all())) {
            return $this->errorResponse('product_related_not_updated', 422);
        }

        return $this->successResponse($result);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $productId
     * @param $relatedId
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($productId, $relatedId)
    {

        if (!$result = $this->repository->findById($productId)) {
            return $this->errorResponse('product_not_found', 422);
        }       

        if (!$result->relateds()->destroy($relatedId)) {
            return $this->errorResponse('product_related_not_removed', 422);
        }

        return $this->successResponse('product_related_removed');

    }

}
