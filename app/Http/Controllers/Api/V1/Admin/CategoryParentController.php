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
     * Display a listing of the resource.
     *
     * @param $category
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($category)
    {

        if (!$result = $this->categoryRepository->findById($category, ['parents'])) {
            return $this->errorResponse('categories_not_found', 422);
        }

        return $this->showAll($result);

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {

        $validator = $this->categoryParentService->validator($request->all());

        if ($validator->fails()) {
            $errors = $validator->errors();
            return $errors->toJson();
        }

        if (!$result = $this->categoryParentService->create($request->all())) {
            return $this->errorResponse('category_not_created', 422);
        }

        return $this->successResponse($result);

    }

    /**
     * Display the specified resource.
     *
     * @param $category
     * @param $parent
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($category, $parent)
    {

        $data = [
            'parent_id' => $category,
            '_id' => $parent
        ];

        if (!$result = $this->categoryParentRepository->whereFirst($data)) {
            return $this->errorResponse('category_not_found', 422);
        }

        return $this->showOne($result);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $category
     * @param $parent
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $category, $parent)
    {

        $validator = $this->categoryParentService->validator($request->all());

        if ($validator->fails()) {
            $errors = $validator->errors();
            return $errors->toJson();
        }

        if (!$result = $this->categoryParentRepository->whereFirst(['parent_id' => $category, '_id' => $parent])) {
            return $this->errorResponse('category_not_found', 422);
        }

        if (!$result = $this->categoryParentRepository->update($parent, $request->all())) {
            return $this->errorResponse('category_not_updated', 422);
        }

        return $this->successResponse($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $category
     * @param $parent
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($category, $parent)
    {

        $data = [
            'parent_id' => $category,
            '_id' => $parent
        ];

        if (!$result = $this->categoryParentRepository->whereFirst($data)) {
            return $this->errorResponse('category_not_found', 422);
        }

        if (!$result = $this->categoryParentRepository->delete($parent)) {
            return $this->errorResponse('category_not_removed', 422);
        }

        return $this->successResponse('category_removed');

    }

}