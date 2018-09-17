<?php

namespace App\Listeners\Log\User;

use App\Events\Log\User\UserAuthenticateEvent;
use App\Entities\Log;
use App\Traits\RequestHeadersTrait;

class UserAuthenticateListener
{

    use RequestHeadersTrait;

    /**
     * Handle the event.
     *
     * @param UserAuthenticateEvent $event
     */
    public function handle(UserAuthenticateEvent $event)
    {
        Log::create([
            'userId' => $event->user->id,
            'headers' => $this->requestHeaders(),
        ]);
    }
}
