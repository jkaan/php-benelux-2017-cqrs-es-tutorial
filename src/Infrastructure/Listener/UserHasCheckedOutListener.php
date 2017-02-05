<?php
/**
 * Created by PhpStorm.
 * User: joey
 * Date: 05/02/2017
 * Time: 22:02
 */

namespace Building\Infrastructure\Listener;


use Building\Domain\DomainEvent\UserHasCheckedOut;

class UserHasCheckedOutListener
{
    public function __invoke(UserHasCheckedOut $event)
    {
        fwrite(fopen('php://stderr', 'w'), "User " . $event->username() . " has checked out\n");
    }
}