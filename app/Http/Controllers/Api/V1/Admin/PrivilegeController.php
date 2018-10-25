<?php

namespace VoceCrianca\Http\Controllers\Api\V1\Admin;

use VoceCrianca\Http\Controllers\ApiController;
use VoceCrianca\Repositories\Privilege\PrivilegeRepositoryInterface;

/**
 * Class PrivilegeController
 * @package VoceCrianca\Http\Controllers\Privilege
 */
class PrivilegeController extends ApiController
{

    /**
     * @var PrivilegeRepositoryInterface
     */
    private $repository;

    /**
     * PrivilegeController constructor.
     * @param PrivilegeRepositoryInterface $repository
     */
    public function __construct(PrivilegeRepositoryInterface $repository)
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
            return $this->errorResponse('privileges_not_found', 404);
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
            return $this->errorResponse('privilege_not_found', 404);
        }

        return $this->showOne($result);

    }

}
