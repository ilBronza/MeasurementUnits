<?php

namespace IlBronza\MeasurementUnits\Http\Controllers\MeasurementUnits;

use IlBronza\CRUD\Traits\CRUDEditUpdateTrait;
use Illuminate\Http\Request;

class MeasurementUnitEditUpdateController extends MeasurementUnitCRUD
{
    use CRUDEditUpdateTrait;

    public $allowedMethods = ['edit', 'update'];

    public function getEditParametersFile() : ? string
    {
        return config('measurementunits.models.measurementUnit.parametersFiles.edit');
    }

    public function edit(string $measurementUnit)
    {
        $measurementUnit = $this->findModel($measurementUnit);

        return $this->_edit($measurementUnit);
    }

    public function update(Request $request, $measurementUnit)
    {
        $measurementUnit = $this->findModel($measurementUnit);

        return $this->_update($request, $measurementUnit);
    }
}
