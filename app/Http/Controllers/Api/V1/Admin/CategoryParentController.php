<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\ApiController;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\CategoryParent\CategoryParentRepositoryInterface;
use App\Services\Admin\CategoryParentService;
use Illuminate\Http\Request;

class CategoryParentController extends ApiController
{

    /**
     * @var CategoryRepositoryInterface
     */
    private $categoryRepository;

    /**
     * @var CategoryParentRepositoryInterface
     */
    private $categoryParentRepository;

    /**
     * @var CategoryParentService
     */
    private $categoryParentService;

    /**
     * CategoryParentController constructor.
     * @param CategoryRepositoryInterface $categoryRepository
     * @param CategoryParentRepositoryInterface $categoryParentRepository
     * @param CategoryParentService $categoryParentService
     */
    public function __construct(CategoryRepositoryInterface $categoryRepository,
                                CategoryParentRepositoryInterface $categoryParentRepository,
                                CategoryParentService $categoryParentService)
    {

        $this->categoryRepository = $categoryRepository;
        $this->categoryParentRepository = $categoryParentRepository;
        $this->categoryParentService = $categoryParentService;
    }

    /**
     * @param $categoryId
     * @return bool
     */
    private function isExistsCategory($categoryId)
    {

        if ($this->categoryRepository->findById($categoryId)) {
            return true;
        }

        return false;

    }

    /**
     * @param $categoryId
     * @param $parentId
     * @return bool|mixed
     */
    private function isExistsCategoryParent($categoryId, $parentId)
    {

        $data = [
            'parent_id' => $categoryId,
            '_id' => $parentId
        ];

        if (!$result = $this->categoryParentRepository->whereFirst($data)) {
            return false;
        }

        return $result;

    }

    /**
     * Display a listing of the resource.
     *
     * @param $categoryId
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($categoryId)
    {

        if (!$result = $this->categoryRepository->findById($categoryId, ['parents'])) {
            return $this->errorResponse('categories_not_found', 422);
        }

        return $this->showAll($result);

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param $categoryId
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, $categoryId)
    {

        $validator = $this->categoryParentService->validator($request->all());

        if ($validator->fails()) {
            $errors = $validator->errors();
            return $errors->toJson();   
        }

        if (!$this->isExistsCategory($request->all()['parent_id'])) {
            return $this->errorResponse('category_not_found', 422);
        }

        if (!$result = $this->categoryParentService->create($request->all(), $categoryId)) {
            return $this->errorResponse('category_not_created', 422);
        }

        return $this->successResponse($result);

    }

    /**
     * Display the specified resource.
     *
     * @param $categoryId
     * @param $parentId
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($categoryId, $parentId)
    {

        if (!$result = $this->isExistsCategoryParent($categoryId, $parentId)) {
            return $this->errorResponse('category_not_found', 422);
        }

        return $this->showOne($result);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $categoryId
     * @param $parentId
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $categoryId, $parentId)
    {

        $validator = $this->categoryParentService->validator($request->all());

        if ($validator->fails()) {
            $errors = $validator->errors();
            return $errors->toJson();
        }
    
        if (!$this->isExistsCategoryParent($categoryId, $parentId)) {
            return $this->errorResponse('category_not_found', 422);
        }

        if (!$result = $this->categoryParentRepository->update($parentId, $request->all())) {
            return $this->errorResponse('category_not_updated', 422);
        }

        return $this->successResponse($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $categoryId
     * @param $parentId
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($categoryId, $parentId)
    {

        if (!$this->isExistsCategoryParent($categoryId, $parentId)) {
            return $this->errorResponse('category_not_found', 422);
        }

        if (!$this->categoryParentRepository->delete($parentId)) {
            return $this->errorResponse('category_not_removed', 422);
        }

        return $this->successResponse('category_removed');

    }

}