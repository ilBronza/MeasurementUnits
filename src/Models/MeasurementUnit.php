<?php

namespace IlBronza\MeasurementUnits\Models;

use IlBronza\CRUD\Traits\CRUDSluggableTrait;
use IlBronza\MeasurementUnits\BaseMeasurementUnit;
use IlBronza\MeasurementUnits\Models\MeasurementUnitPackageBaseModel;
use Illuminate\Support\Str;

class MeasurementUnit extends MeasurementUnitPackageBaseModel
{
    use CRUDSluggableTrait;

    static $deletingRelationships = [
    ];

    static function getSlugField()
    {
        return "id";
    }

    public function getBaseMeasurementUnit() : string
    {
        return $this->base_measurement_unit;
    }

    public function getHelper() : BaseMeasurementUnit
    {
        $helperPath = config('measurementUnits.helpers.' . $this->getBaseMeasurementUnit());

        return new $helperPath();
    }
}