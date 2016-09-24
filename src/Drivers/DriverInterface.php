<?php

namespace FlyingLuscas\BugNotifier\Drivers;

use FlyingLuscas\BugNotifier\Message;

interface DriverInterface
{
    /**
     * Handle the notification message.
     *
     * @param \FlyingLuscas\BugNotifier\Message $message
     *
     * @return void
     */
    public function handle(Message $message);
}
