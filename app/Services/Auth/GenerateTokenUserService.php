<?php

namespace VoceCrianca\Services\Auth;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;
use VoceCrianca\Mail\Admin\ResetPasswordMail;
use VoceCrianca\Models\User;

/**
 * Class GenerateTokenUserService
 * @package VoceCrianca\Services\Auth
 */
class GenerateTokenUserService
{

    /**
     * Generate Token And Send Email
     *
     * @param array $request
     * @return string
     */
    public function make(array $request)
    {

        $user = User::where($request)->first();

        if(!$user) {
            return false;
        }

        $user->tokenResetPassword()
             ->delete();

        $user->tokenResetPassword()->create([
            'token' => str_random(40),
            'time' => time() + 60*60*4
        ]);

        $createdToken = User::find($user->id);

        Mail::to($user->email)
            ->send( new ResetPasswordMail( $createdToken ) );

        return true;
    }

}
