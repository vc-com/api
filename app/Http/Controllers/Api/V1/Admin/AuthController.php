<?php

namespace VoceCrianca\Http\Controllers\Api\V1\Admin;
    
use VoceCrianca\Factories\JWTTokenBearerFactory;
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
     * @var JWTTokenBearerFactory
     */
    private $bearerFactory;

    /**
     * AuthController constructor.
     * @param JWTTokenBearerFactory $bearerFactory
     */
    public function __construct(JWTTokenBearerFactory $bearerFactory, UserRepositoryInterface $repository)
    {
        $this->bearerFactory = $bearerFactory;
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

        $res = $this->repository->whereFirst(['email' => $request->email]);

        $data = $this->repository->findById($res->id, ['roles']);

        //Authorization || HTTP_Authorization
        return $this->successResponse([
            'HTTP_Authorization' => $this->bearerFactory->generate($request),
            'HTTP_Data' => $data
        ]);

    }

}
