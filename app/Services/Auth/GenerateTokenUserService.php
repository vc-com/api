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

        $user = User::where($request)->get()->first();  

        Mail::to($user->email)
            ->send( new ResetPasswordMail( $user ) );

        return true;
    }

}
