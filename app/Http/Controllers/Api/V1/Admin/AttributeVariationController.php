<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\ApiController;
use App\Repositories\Attribute\AttributeRepositoryInterface;
use Illuminate\Http\Request;

class AttributeVariationController extends ApiController
{
    
    /**
     * @var AttributeRepositoryInterface
     */
    private $repository;

    /**
     * AttributeVariationController constructor.
     * @param AttributeRepositoryInterface $repository
     */
    public function __construct(AttributeRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param $attributeId
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($attributeId)
    {

        if (!$result = $this->repository->findById($attributeId)) {
            return $this->errorResponse('attribute_not_found', 422);
        }       

        if (!$variations = $result->variations()->all()) {
            return $this->errorResponse('attribute_variations_not_found', 422);
        }

        return $this->showAll($variations);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param $attributeId
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, $attributeId)
    {

        if (!$result = $this->repository->findById($attributeId)) {
            return $this->errorResponse('attribute_not_found', 422);
        } 

        $total = $result->variations()
                    ->where('name', $request->all()['name'])
                    ->orWhere('hex', $request->all()['hex'])
                    ->count();

        if ($total !== 0 ) {
            return $this->successResponse('attribute_variation_is_exists');
        }

        if (!$result = $result->variations()->create($request->all())) {
            return $this->errorResponse('attribute_variation_not_created', 500);
        }

        return $this->successResponse($result);

    }


    /**
     * Display the specified resource.
     *
     * @param $attributeId
     * @param $variationId
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($attributeId, $variationId)
    {

        if (!$result = $this->repository->findById($attributeId)) {
            return $this->errorResponse('attribute_not_found', 422);
        }       

        if (!$phone = $result->variations()->find($variationId)) {
            return $this->errorResponse('attribute_variation_not_found', 422);
        }

        return $this->showOne($phone);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $attributeId
     * @param $variationId
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $attributeId, $variationId)
    {
  
        if (!$result = $this->repository->findById($attributeId)) {
            return $this->errorResponse('attribute_not_found', 422);
        }

        $total = $result->variations()
                        ->where('_id', '!=', $variationId)
                        ->where('name', $request->all()['name'])
                        ->count();

        if ($total !== 0 ) {
            return $this->successResponse('attribute_variation_is_exists');
        }

        if (!$result = $result->variations()->find($variationId)->update($request->all())) {
            return $this->errorResponse('attribute_variation_not_updated', 422);
        }

        return $this->successResponse($result);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $attributeId
     * @param $variationId
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($attributeId, $variationId)
    {

        if (!$result = $this->repository->findById($attributeId)) {
            return $this->errorResponse('attribute_not_found', 422);
        }       

        if (!$result->variations()->destroy($variationId)) {
            return $this->errorResponse('attribute_variation_not_removed', 422);
        }

        return $this->successResponse('attribute_variation_removed');

    }

}
