<?php

namespace VoceCrianca\Http\Controllers\Api\V1\Admin\Setting\Permission;

use VoceCrianca\Http\Controllers\ApiController;
use VoceCrianca\Repositories\Role\RoleRepositoryInterface;
use VoceCrianca\Services\Admin\Setting\Permission\RoleService;
use Illuminate\Http\Request;

class RoleController extends ApiController
{

    /**
     * @var RoleRepositoryInterface
     */
    private $repository;

    /**
     * @var RoleService
     */
    private $service;


    /**
     * PrivilegeController constructor.
     * @param RoleRepositoryInterface $repository
     * @param RoleService $service
     */
    public function __construct(RoleRepositoryInterface $repository, RoleService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {

        $result = $this->repository
            ->setSelect([
                '_id',
                'description', 
                'name', 
                'default',  
                'privileges'
            ])
            ->setOrderColumn('name')
            ->all(['privileges']);

        if (! $result) {
            return $this->errorResponse('roles_not_found', 404);
        }

        return $this->showAll($result);

    }

    /**
     *
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function store(Request $request)
    {

        $validator = $this->service->validator($request);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return $this->errorResponse($errors->toJson(), 422);
        }

        if (!$result = $this->service->create($request)) {
            return $this->errorResponse('role_not_created', 500);
        }
        
        return $this->successResponse($result);

    }


      /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {

        if (!$result = $this->repository->findById($id)) {
            return $this->errorResponse('role_not_found', 404);
        }

        return $this->showOne($result);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {

        $validator = $this->service->validator($request, $id);     

        if ($validator->fails()) {
            $errors = $validator->errors();
            return $this->errorResponse($errors->toJson(), 422);
        }

        if (!$result = $this->repository->findById($id)) {
            return $this->errorResponse('role_not_found', 404);
        }

        if (!$result = $this->service->update($request, $id)) {
            return $this->errorResponse('role_not_updated', 500);
        }

        return $this->successResponse($result);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {

        if (!$result = $this->repository->findById($id)) {
            return $this->errorResponse('role_not_found', 404);
        }

        if (!$this->service->delete($id)) {
            return $this->errorResponse('role_not_removed', 500);
        }

        return $this->successResponse('role_removed');

    }
}
