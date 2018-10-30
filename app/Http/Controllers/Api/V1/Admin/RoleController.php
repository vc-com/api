<?php

namespace VoceCrianca\Http\Controllers\Api\V1\Admin;

use VoceCrianca\Http\Controllers\ApiController;
use VoceCrianca\Repositories\Role\RoleRepositoryInterface;

/**
 * Class RoleController
 * @package VoceCrianca\Http\Controllers\Privilege
 */
class RoleController extends ApiController
{

    /**
     * @var RoleRepositoryInterface
     */
    private $repository;

    /**
     * PrivilegeController constructor.
     * @param RoleRepositoryInterface $repository
     */
    public function __construct(RoleRepositoryInterface $repository)
    {
        $this->repository = $repository;
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
            ->all(['privileges']);

        if (! $result) {
            return $this->errorResponse('roles_not_found', 404);
        }

        return $this->showAll($result);

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

}
