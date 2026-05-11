<?php

namespace IlBronza\MeasurementUnits\Http\Controllers\MeasurementUnits;

use IlBronza\MeasurementUnits\Http\Controllers\CRUDMeasurementUnitsPackageController;

class MeasurementUnitCRUD extends CRUDMeasurementUnitsPackageController
{
    public ?bool $updateEditor = false;

    public $configModelClassName = 'measurementUnit';
}
