<?php

namespace VoceCrianca\Observers\Admin;

use Illuminate\Http\Request;
use VoceCrianca\Models\User;
use Illuminate\Support\Facades\Mail;
use VoceCrianca\Mail\Admin\AccountCreateMail;

class UserObserver
{  

    public function created(User $user)
    {        
        Mail::send( new AccountCreateMail( User::find( $user->id ) ) );
    }

}
