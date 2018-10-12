<?php

namespace VoceCrianca\Listeners\Log\User;

use VoceCrianca\Events\Log\User\UserAuthenticateEvent;
use VoceCrianca\Models\Log;
use VoceCrianca\Traits\RequestHeadersTrait;

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
            'user_id' => $event->user->id,
            'headers' => $this->requestHeaders(),
        ]);
    }
}
