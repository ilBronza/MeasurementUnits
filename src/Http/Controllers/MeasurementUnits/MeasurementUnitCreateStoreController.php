<?php

namespace IlBronza\MeasurementUnits\Http\Controllers\MeasurementUnits;

use IlBronza\CRUD\Traits\CRUDCreateStoreTrait;
use IlBronza\CRUD\Traits\CRUDRelationshipTrait;
use IlBronza\CRUD\Traits\CRUDShowTrait;

class MeasurementUnitCreateStoreController extends MeasurementUnitCRUD
{
    use CRUDCreateStoreTrait;
    use CRUDShowTrait;
    use CRUDRelationshipTrait;

    public $allowedMethods = ['create', 'store', 'edit', 'update', 'show'];

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
