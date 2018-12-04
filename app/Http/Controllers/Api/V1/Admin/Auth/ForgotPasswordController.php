<?php

namespace VoceCrianca\Http\Controllers\Api\V1\Admin\Auth;

use VoceCrianca\Http\Controllers\ApiController;
use VoceCrianca\Services\Auth\ChangePasswordUserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Class ForgotPasswordController
 * @package VoceCrianca\Http\Controllers\Api\V1\Admin\Auth
 */
class ForgotPasswordController extends ApiController
{

    /**
     * @var ChangePasswordUserService
     */
    private $service;

    /**
     * ForgotPasswordController constructor.
     * @param ChangePasswordUserService $service
     */
    public function __construct(ChangePasswordUserService $service)
    {
        $this->service = $service;
    }
    
    /**
     * Change New Password
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function forgot(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|string',
            'token' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return $this->errorResponse($errors->toJson(), 422);
        }

        if (!$this->service->change($request->all())) {
            return $this->errorResponse(['data' => 'error_update_password'], 500);
        }

        return $this->successResponse(['data' => 'update_password']);

    }
}
