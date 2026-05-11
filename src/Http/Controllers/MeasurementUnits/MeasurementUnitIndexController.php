<?php

namespace IlBronza\MeasurementUnits\Http\Controllers\MeasurementUnits;

use IlBronza\CRUD\Traits\CRUDIndexTrait;
use IlBronza\CRUD\Traits\CRUDPlainIndexTrait;

class MeasurementUnitIndexController extends MeasurementUnitCRUD
{
    use CRUDPlainIndexTrait;
    use CRUDIndexTrait;

    public $allowedMethods = ['index'];

    public function getIndexFieldsArray()
    {
        return config('measurementunits.models.measurementUnit.fieldsGroupsFiles.index')::getTracedFieldsGroup();
    }

    public function getIndexElements()
    {
        return $this->getModelClass()::all();
    }
}
