<?php

namespace IlBronza\MeasurementUnits\Http\Controllers\MeasurementUnits;

use IlBronza\CRUD\Traits\CRUDRelationshipTrait;
use IlBronza\CRUD\Traits\CRUDShowTrait;

class MeasurementUnitShowController extends MeasurementUnitCRUD
{
    use CRUDShowTrait;
    use CRUDRelationshipTrait;

    public $allowedMethods = ['show'];

    public function getGenericParametersFile() : ? string
    {
        return config('measurementunits.models.measurementUnit.parametersFiles.create');
    }

    public function getRelationshipsManagerClass()
    {
        return config("measurementunits.models.{$this->configModelClassName}.relationshipsManagerClasses.show");
    }

    public function show(string $measurementUnit)
    {
        $measurementUnit = $this->findModel($measurementUnit);

        return $this->_show($measurementUnit);
    }
}
