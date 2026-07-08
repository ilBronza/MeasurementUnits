<?php

namespace IlBronza\MeasurementUnits\Http\Controllers\MeasurementUnits;

use IlBronza\CRUD\Traits\CRUDCreateStoreTrait;
use IlBronza\CRUD\Traits\CRUDRelationshipTrait;

class MeasurementUnitStoreController extends MeasurementUnitCRUD
{
    use CRUDCreateStoreTrait;
    use CRUDRelationshipTrait;

    public $allowedMethods = ['store'];

    public function getStoreParametersFile() : ? string
    {
        return config('measurementunits.models.measurementUnit.parametersFiles.store')
            ?? config('measurementunits.models.measurementUnit.parametersFiles.create');
    }
}
