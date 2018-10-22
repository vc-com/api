<?php

namespace VoceCrianca\Http\Controllers\Api\V1\Admin;
    
use VoceCrianca\Http\Controllers\ApiController;
use VoceCrianca\Repositories\User\UserRepositoryInterface;
use VoceCrianca\Services\Auth\ChangePasswordUserService;
use VoceCrianca\Services\Auth\GenerateTokenUserService;
use Illuminate\Http\Request;
use JWTAuth;
use JWTFactory;


/**
 * Class AuthController
 * @package VoceCrianca\Http\Controllers\Api\V1\Admin
 */
class AuthController extends ApiController
{

    /**
     * @var UserRepositoryInterface
     */
    private $repository;

    /**
     * @var GenerateTokenUserService
     */
    private $generateTokenUserService;
    /**
     * @var ChangePasswordUserService
     */
    private $changePasswordUserService;

    /**
     * AuthController constructor.
     * @param UserRepositoryInterface $repository
     * @param GenerateTokenUserService $generateTokenUserService
     * @param ChangePasswordUserService $changePasswordUserService
     */
    public function __construct(UserRepositoryInterface $repository,
                                GenerateTokenUserService $generateTokenUserService,
                                ChangePasswordUserService $changePasswordUserService)
    {
        $this->repository = $repository;
        $this->generateTokenUserService = $generateTokenUserService;
        $this->changePasswordUserService = $changePasswordUserService;
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

    /**
     * @param Request $request
     * @return string
     */
    public function reset(Request $request)
    {

        $res = $this->generateTokenUserService->make( $request->only('email') );

        if (!$res) {
            return $this->errorResponse('email_not_found', 422);
        }

        return $this->successResponse('token_created');

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkToken(Request $request)
    {

        $res = $this->changePasswordUserService->make( $request->only('email') );

        if (!$res) {
            return $this->errorResponse('token_not_found', 422);
        }

        return $this->successResponse('token_found');


    }


    /**
     * Change New Password
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function changePassword(Request $request)
    {

        $data = $request->only('email');

        $res = $this->changePasswordUserService->make( $data );

        if (!$res) {
            return $this->errorResponse('error_update_password', 422);
        }

        return $this->successResponse('update_password');


    }

}
