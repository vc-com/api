<?php

namespace App\Http\Controllers\Privilege;

use App\Http\Controllers\ApiController;
use App\Repositories\Role\RoleRepositoryInterface;

/**
 * Class RoleController
 * @package App\Http\Controllers\Privilege
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

        if (!$result = $this->repository->all()) {
            return $this->errorResponse('roles_not_found', 422);
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
            return $this->errorResponse('role_not_found', 422);
        }

        return $this->showOne($result);

    }

}
