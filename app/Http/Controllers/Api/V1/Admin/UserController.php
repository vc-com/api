<?php

namespace VoceCrianca\Http\Controllers\Api\V1\Admin;

use VoceCrianca\Http\Controllers\ApiController;

use VoceCrianca\Repositories\User\UserRepositoryInterface;
use VoceCrianca\Services\Admin\UserService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends ApiController
{

    /**
     * @var UserService
     */
    private $service;

    /**
     * @var UserRepositoryInterface
     */
    private $repository;

    /**
     * UserController constructor.
     * @param UserService $service
     * @param UserRepositoryInterface $repository
     */
    public function __construct(UserService $service,
                                UserRepositoryInterface $repository)
    {
        $this->service = $service;
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */ 
    public function index()
    {
        if (!$result = $this->repository->setOrderColumn('name')->all(['roles'])) {
            return $this->errorResponse('users_not_found', 404);
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

        $validator = $this->service->validator($request->all());

        if ($validator->fails()) {
            $errors = $validator->errors();
            return $this->errorResponse($errors->toJson(), 422);
        }

        if (!$result = $this->service->create($request)) {

            return $this->errorResponse('user_not_created', 500);
        }

        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {

            return $this->errorResponse('invalid_credentials', 401);

        }

        //Authorization || HTTP_Authorization
        return $this->successResponse([
            'HTTP_Authorization' => $this->tokenBearerGenerate($request)
        ], 201);

    }


    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {

        if (!$result = $this->repository->findById($id, ['roles'])) {
            return $this->errorResponse('user_not_found', 404);
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

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email,'.$id.',_id',
            'password' => 'sometimes|required|min:6|max:255'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return $this->errorResponse($errors->toJson(), 422);
        }

        if (!$result = $this->repository->findById($id)) {
            return $this->errorResponse('user_not_found', 404);
        }

        if (!$result = $this->service->update($request, $id)) {
            return $this->errorResponse('user_not_updated', 500);
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
            return $this->errorResponse('user_not_found', 404);
        }

        if (!$this->repository->delete($id)) {
            return $this->errorResponse('user_not_removed', 500);
        }

        return $this->successResponse('user_removed');

    }
    
}
