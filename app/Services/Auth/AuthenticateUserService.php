<?php

namespace VoceCrianca\Services\Auth;

use VoceCrianca\Events\Log\User\UserAuthenticateEvent;
use VoceCrianca\Models\User;

/**
 * Class AuthenticateUserService
 * @package VoceCrianca\Services\Auth
 */
class AuthenticateUserService
{

    /**
     * @param array $data
     * @return User|bool|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|null|object
     */
    public function authenticate(array $data)
    {

        $user = User::with('roles');

        if (!$user = $user->where($data)->first() ) {
            return false;
        }

        //event(new UserAuthenticateEvent($user));

        return $user;

    }

}
