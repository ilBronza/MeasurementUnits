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

    public function getDeadlineValue($initialValue, $validity) : mixed
    {
        $measurementUnitHelper = $this->getHelper();

        $deadlineValue = $measurementUnitHelper->getDeadlineValue(
            $this->convertToBaseUnitValue($initialValue),
            $this->convertToBaseUnitValue($validity)
        );

        return $this->getFromBaseUnitValue($deadlineValue);
    }

    public function getBeforeValue($deadlineValue, $before) : mixed
    {
        $measurementUnitHelper = $this->getHelper();

        $deadlineValue = $measurementUnitHelper->getBeforeValue(
            $this->convertToBaseUnitValue($deadlineValue),
            $this->convertToBaseUnitValue($before)
        );

        return $this->getFromBaseUnitValue($deadlineValue);
    }

    public function getProportionCoefficien() : float
    {
        return $this->proportion_toward_base_measurement_unit;
    }

    public function convertToBaseUnitValue($value) : float
    {
        return $this->getProportionCoefficien() * $value;
    }

    public function getFromBaseUnitValue($value) : float
    {
        return $value / $this->getProportionCoefficien();
    }
}