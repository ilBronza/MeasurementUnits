<?php

namespace IlBronza\MeasurementUnits\Http\Controllers\MeasurementUnits;

use IlBronza\CRUD\Traits\CRUDDeleteTrait;

class MeasurementUnitDestroyController extends MeasurementUnitCRUD
{
    use CRUDDeleteTrait;

    public $allowedMethods = ['destroy'];

    public function destroy($measurementUnit)
    {
        $measurementUnit = $this->findModel($measurementUnit);

        return $this->_destroy($measurementUnit);
    }
}
