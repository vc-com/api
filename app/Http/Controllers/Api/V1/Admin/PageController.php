<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\ApiController;
use App\Repositories\Page\PageRepositoryInterface;
use App\Services\Admin\PageService;
use Illuminate\Http\Request;

class PageController extends ApiController
{
    /**
     * @var PageRepositoryInterface
     */
    private $repository;

    /**
     * @var PageService
     */
    private $service;

    /**
     * PageController constructor.
     * @param PageRepositoryInterface $repository
     * @param PageService $service
     */
    public function __construct(PageRepositoryInterface $repository,
                                PageService $service)
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

        if (!$result = $this->repository->all()) {
            return $this->errorResponse('pages_not_found', 422);
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

        $validator = $this->service->validator($request->all());

        if ($validator->fails()) {
            $errors = $validator->errors();
            return $errors->toJson();
        }

        if (!$result = $this->repository->create($request->all())) {
            return $this->errorResponse('page_not_created', 422);
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
            return $this->errorResponse('page_not_found', 422);
        }

        return $this->showOne($result);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {


        $validator = $this->service->validator($request->all(), $id);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return $errors->toJson();
        }


        if (!$result = $this->repository->findById($id)) {
            return $this->errorResponse('page_not_found', 422);
        }

        if (!$result = $this->repository->update($id, $request->all())) {
            return $this->errorResponse('page_not_updated', 422);
        }

        return $this->successResponse($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if (!$this->repository->findById($id)) {
            return $this->errorResponse('page_not_found', 422);
        }

        if (!$this->repository->delete($id)) {
            return $this->errorResponse('page_not_removed', 422);
        }

        return $this->successResponse('page_removed');
    }

}