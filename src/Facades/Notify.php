<?php

namespace FlyingLuscas\BugNotifier\Facades;

use Illuminate\Support\Facades\Facade;

class Notify extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'BugNotifier';
    }
}
