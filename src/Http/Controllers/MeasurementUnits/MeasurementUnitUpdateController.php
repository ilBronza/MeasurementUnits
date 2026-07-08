<?php

namespace IlBronza\MeasurementUnits\Http\Controllers\MeasurementUnits;

use IlBronza\CRUD\Traits\CRUDUpdateTrait;
use Illuminate\Http\Request;

class MeasurementUnitUpdateController extends MeasurementUnitCRUD
{
    use CRUDUpdateTrait;

    public $allowedMethods = ['update'];

    public function getUpdateParametersFile() : ? string
    {
        return config('measurementunits.models.measurementUnit.parametersFiles.update')
            ?? config('measurementunits.models.measurementUnit.parametersFiles.edit');
    }

    public function update(Request $request, string $measurementUnit)
    {
        $measurementUnit = $this->findModel($measurementUnit);

        return $this->_update($request, $measurementUnit);
    }
}
