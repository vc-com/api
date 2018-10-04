<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\ApiController;
use App\Repositories\Category\CategoryRepositoryInterface;
use Illuminate\Http\Request;

class CategoryParentController extends ApiController
{

    /**
     * @var CategoryRepositoryInterface
     */
    private $repository;

    /**
     * CategoryParentController constructor.
     * @param CategoryRepositoryInterface $repository
     */
    public function __construct(CategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param $parentId
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, $parentId)
    {

        if (!$this->repository->whereFirst(['parent_id' => $parentId])) {
            return $this->errorResponse('category_parent_not_found', 422);
        }

        $data = [
            'parent_id' => $parentId,
            'name' => $request->input('name')
        ];

        if ( $this->repository->whereFirst($data) ) {
            return $this->successResponse('category_parent_is_exists');
        }

        $request = $request->all();
        unset($request['parent_id']);
        $request['parent_id'] = $parentId;

        if (!$result = $this->repository->create( $request )) {
            return $this->errorResponse('category_parent_not_created', 500);
        }

        return $this->successResponse($result);

    }

    /**
     * Display the specified resource.
     *
     * @param $parentId
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($parentId, $id)
    {

        $data = [
            '_id' => $id,
            'parent_id' => $parentId,
        ];

        if (!$result = $this->repository->whereFirst($data)) {
            return $this->errorResponse('category_parent_not_found', 422);
        }

        return $this->showOne($result);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $parentId
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $parentId, $id)
    {
        
        if (!$this->repository->isExistsParent($parentId, $id)) {
            return $this->errorResponse('category_or_parent_not_exists', 422);
        }

        $data = [
            'parent_id' => $parentId,
            'name' => $request->input('name')
        ];

        if ( $this->repository->whereFirst($data) ) {
            return $this->successResponse('category_parent_is_exists');
        }

        $exists = $this->repository->isExistsNameParent($parentId, $request->input('name'), $id);

        if ($exists) {
            return $this->successResponse('category_parent_is_exists');
        }

        $request = $request->all();
        unset($request['parent_id']);
        $request['parent_id'] = $parentId;

        if (!$result = $this->repository->update($id, $request) ) {
            return $this->errorResponse('category_parent_not_updated', 422);
        }

        return $this->successResponse($result);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $parentId
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($parentId, $id)
    {

        if (!$this->repository->isExistsParent($parentId, $id)) {
            return $this->errorResponse('category_or_parent_not_exists', 422);
        }       

        if (!$this->repository->delete($id)) {
            return $this->errorResponse('category_parent_not_removed', 422);
        }

        return $this->successResponse('category_parent_removed');

    }

}