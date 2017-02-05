<?php

namespace Building\Infrastructure\Listener;

use Building\Domain\DomainEvent\UserHasCheckedIn;

class UserHasCheckedInListener
{
    public function __invoke(UserHasCheckedIn $event)
    {
        fwrite(fopen('php://stderr', 'w'), "User " . $event->username() . " has checked in\n");
    }
}