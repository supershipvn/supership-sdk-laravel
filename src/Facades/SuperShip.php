<?php

namespace SuperShipVN\SuperShip\Facades;

use Illuminate\Support\Facades\Facade;

class SuperShip extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'supership';
    }
}
