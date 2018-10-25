<?php

namespace VoceCrianca\Http\Controllers\Api\V1\Admin;

use VoceCrianca\Http\Controllers\ApiController;
use VoceCrianca\Repositories\Product\ProductRepositoryInterface;
use Illuminate\Http\Request;

class ProductImageController extends ApiController
{
    
    /**
     * @var ProductRepositoryInterface
     */
    private $repository;

    /**
     * ProductImageController constructor.
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
            return $this->errorResponse('product_not_found', 404);
        }       

        if (!$images = $result->images()->all()) {
            return $this->errorResponse('product_images_not_found', 404);
        }

        return $this->showAll($images);

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
            return $this->errorResponse('product_not_found', 404);
        } 

        $total = $result->images()
                    ->where('image', $request->all()['image'])
                    ->count();

        if ($total !== 0 ) {
            return $this->successResponse('product_image_is_exists');
        }

        if (!$result = $result->images()->create($request->all())) {
            return $this->errorResponse('product_image_not_created', 500);
        }

        return $this->successResponse($result);

    }


    /**
     * Display the specified resource.
     *
     * @param $productId
     * @param $imageId
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($productId, $imageId)
    {

        if (!$result = $this->repository->findById($productId)) {
            return $this->errorResponse('product_not_found', 404);
        }       

        if (!$image = $result->images()->find($imageId)) {
            return $this->errorResponse('product_image_not_found', 404);
        }

        return $this->showOne($image);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $productId
     * @param $imageId
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $productId, $imageId)
    {
  
        if (!$result = $this->repository->findById($productId)) {
            return $this->errorResponse('product_not_found', 404);
        }  

        $total = $result->images()
                        ->where('_id', '!=', $imageId)
                        ->where('image', $request->all()['image'])
                        ->count();

        if ($total !== 0 ) {
            return $this->successResponse('product_image_is_exists');
        }

        if (!$result = $result->images()->find($imageId)->update($request->all())) {
            return $this->errorResponse('product_image_not_updated', 500);
        }

        return $this->successResponse($result);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $productId
     * @param $imageId
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($productId, $imageId)
    {

        if (!$result = $this->repository->findById($productId)) {
            return $this->errorResponse('product_not_found', 404);
        }       

        if (!$result->images()->destroy($imageId)) {
            return $this->errorResponse('product_image_not_removed', 500);
        }

        return $this->successResponse('product_image_removed');

    }

}
