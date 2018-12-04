<?php

namespace VoceCrianca\Http\Controllers\Api\V1\Admin\Auth;

use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use VoceCrianca\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Token;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

/**
 * Class RefreshTokenController
 * @package VoceCrianca\Http\Controllers\Api\V1\Admin\Auth
 */
class RefreshTokenController extends ApiController
{

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh(Request $request)
    {

        try {
            JWTAuth::parseToken();
            $token = JWTAuth::getToken();
        } catch (JWTException $e) {
            abort(401, 'Token missing or badly formatted');
        }

        // Try to verify token
        try {
            // If sucessful, save user on request
            $new_token = JWTAuth::authenticate($token);
        }

        catch (TokenBlacklistedException $e) {
            abort(401, 'Token "' . JWTAuth::manager()->decode($token, false)['jti'] . '" Blacklisted');
        }

        // If token has expired...
        catch (TokenExpiredException $e) {

            try {
                // Try to refresh token
                $token = JWTAuth::refresh($token);
                JWTAuth::setToken($token);    

                // Authenticate with new token, save user on request
                $new_token = JWTAuth::authenticate($token);

                //Authorization || HTTP_Authorization
                return $this->successResponse([
                    'HTTP_Authorization' => $new_token
                ]);
                
            }

            // If token refresh period has expired...
            catch(TokenExpiredException $e) {
                
                // Return 401 status
                abort(401, 'Token Expired');
            }
        }



        $validator = Validator::make($request->all(), [
            'token' => 'required|string',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return $this->errorResponse($errors->toJson(), 422);
        }

        try {

            $token = JWTAuth::getToken();
            $new_token = JWTAuth::refresh($token);

        } catch (TokenInvalidException $e) {
            return $this->errorResponse(['data' => 'token_invalid'], 500);
        }

        //Authorization || HTTP_Authorization
        return $this->successResponse([
            'HTTP_Authorization' => $new_token
        ]);

    }

}
