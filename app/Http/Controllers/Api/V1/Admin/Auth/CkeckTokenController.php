<?php

namespace VoceCrianca\Http\Controllers\Api\V1\Admin\Auth;

use VoceCrianca\Http\Controllers\ApiController;
use VoceCrianca\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Class CkeckTokenController
 * @package VoceCrianca\Http\Controllers\Api\V1\Admin\Auth
 */
class CkeckTokenController extends ApiController
{

    /**
     * @var UserRepositoryInterface
     */
    private $repository;

    /**
     * CkeckTokenController constructor.
     * @param UserRepositoryInterface $repository
     */
    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    } 

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function check(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'token' => 'required|string',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return $this->errorResponse($errors->toJson(), 422);
        }

        if (!$token = $this->repository->checkToken($request->only('token'))) {
            return $this->errorResponse('token_not_found', 404);
        }

        return $this->showOne($token);

    }

}
