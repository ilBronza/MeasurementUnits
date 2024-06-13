<?php

namespace IlBronza\MeasurementUnits\Models;

use IlBronza\CRUD\Traits\CRUDSluggableTrait;
use IlBronza\MeasurementUnits\BaseMeasurementUnitHelpers\BaseMeasurementUnitHelper;
use IlBronza\MeasurementUnits\Helpers\BaseMeasurementUnitCreatorHelper;
use IlBronza\MeasurementUnits\Models\MeasurementUnitPackageBaseModel;
use Illuminate\Support\Str;

class MeasurementUnit extends MeasurementUnitPackageBaseModel
{
    use CRUDSluggableTrait;

    public BaseMeasurementUnitHelper $helper;

    static $deletingRelationships = [
    ];

    static function getSlugField()
    {
        return "id";
    }

    public function getBaseMeasurementUnitHelper() : string
    {
        return $this->base_measurement_unit;
    }

    public function getHelper() : BaseMeasurementUnitHelper
    {
        if(isset($this->helper))
            return $this->helper;

        $this->helper = BaseMeasurementUnitCreatorHelper::createHelperByMeasurementUnit($this);

        return $this->helper;
    }

    public function getProportionCoefficien() : float
    {
        return $this->proportion_toward_base_measurement_unit;
    }

    public function convertToBaseUnitValue($value) : mixed
    {
        if($this->getProportionCoefficien() == 1)
            return $value;

        return $this->getProportionCoefficien() * $value;
    }

    public function getFromBaseUnitValue($value) : mixed
    {
        if($this->getProportionCoefficien() == 1)
            return $value;

        return $value / $this->getProportionCoefficien();
    }
}