<?php

namespace VoceCrianca\Http\Controllers\Api\V1\Admin\Auth;

use VoceCrianca\Http\Controllers\ApiController;
use VoceCrianca\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use JWTFactory;

/**
 * Class LoginController
 * @package VoceCrianca\Http\Controllers\Api\V1\Admin\Auth
 */
class LoginController extends ApiController
{

    /**
     * @var UserRepositoryInterface
     */
    private $repository;

    /**
     * LoginController constructor.
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
    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return $this->errorResponse($errors->toJson(), 422);
        }

        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return $this->errorResponse('invalid_credentials', 401);
        }

        //Authorization || HTTP_Authorization
        return $this->successResponse([
            'HTTP_Authorization' => $token,
            'HTTP_Data' => $this->repository->getDataUserLogin(['email' => $request->email])
        ]);

    }

}
