<?php

namespace VoceCrianca\Http\Controllers\Api\V1\Admin\Auth;

use VoceCrianca\Http\Controllers\ApiController;
use VoceCrianca\Services\Auth\GenerateTokenUserService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ResetPasswordController extends ApiController
{

    /**
     * @var GenerateTokenUserService
     */
    private $service;

    /**
     * ResetPasswordController constructor.
     * @param GenerateTokenUserService $service
     */
    public function __construct(GenerateTokenUserService $service)
    {
        $this->service = $service;
    }

    /**
     * @param Request $request
     * @return string
     */
    public function reset(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return $this->errorResponse($errors->toJson(), 422);
        }

        if (!$this->service->make($request->only('email'))) {
            return $this->errorResponse(['data' => 'email_not_found'], 404);
        }

        return $this->successResponse(['data' => 'token_created']);

    }

}
