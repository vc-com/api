<?php

namespace VoceCrianca\Http\Controllers\Api\V1\Admin;
    
use VoceCrianca\Http\Controllers\ApiController;
use VoceCrianca\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use JWTAuth;
use JWTFactory;


class AuthController extends ApiController
{

    /**
     * @var UserRepositoryInterface
     */
    private $repository;

    /**
     * AuthController constructor.
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
