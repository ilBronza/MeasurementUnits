<?php

namespace IlBronza\MeasurementUnits\Http\Controllers\MeasurementUnits;

use IlBronza\CRUD\Traits\CRUDCreateStoreTrait;
use IlBronza\CRUD\Traits\CRUDRelationshipTrait;

class MeasurementUnitCreateController extends MeasurementUnitCRUD
{
    use CRUDCreateStoreTrait;
    use CRUDRelationshipTrait;

    public $allowedMethods = ['create'];

    public function getCreateParametersFile() : ? string
    {
        return config('measurementunits.models.measurementUnit.parametersFiles.create');
    }
}
