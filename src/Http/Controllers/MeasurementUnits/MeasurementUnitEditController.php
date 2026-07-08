<?php

namespace IlBronza\MeasurementUnits\Http\Controllers\MeasurementUnits;

use IlBronza\CRUD\Traits\CRUDEditUpdateTrait;

class MeasurementUnitEditController extends MeasurementUnitCRUD
{
    use CRUDEditUpdateTrait;

    public $allowedMethods = ['edit'];

    public function getEditParametersFile() : ? string
    {
        return config('measurementunits.models.measurementUnit.parametersFiles.edit');
    }

    public function edit(string $measurementUnit)
    {
        $measurementUnit = $this->findModel($measurementUnit);

        return $this->_edit($measurementUnit);
    }
}
