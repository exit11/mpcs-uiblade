<?php

namespace Exit11\UiBlade\Facades;

use Illuminate\Support\Facades\Facade;

class UiBlade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Exit11\UiBlade\UiBlade::class;
    }
}
