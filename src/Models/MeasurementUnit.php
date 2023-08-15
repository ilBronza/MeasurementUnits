<?php

namespace IlBronza\MeasurementUnits\Models;

use IlBronza\CRUD\Traits\CRUDSluggableTrait;
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
}