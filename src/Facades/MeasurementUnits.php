<?php

namespace IlBronza\MeasurementUnits\Facades;

use Illuminate\Support\Facades\Facade;

class MeasurementUnits extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'measurementunits';
    }
}
