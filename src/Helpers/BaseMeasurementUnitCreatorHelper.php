<?php

namespace IlBronza\MeasurementUnits\Helpers;

use IlBronza\MeasurementUnits\BaseMeasurementUnitHelpers\BaseMeasurementUnitHelper;
use IlBronza\MeasurementUnits\Models\MeasurementUnit;

class BaseMeasurementUnitCreatorHelper
{
    static function createHelperByMeasurementUnit(MeasurementUnit $measurementUnit) : BaseMeasurementUnitHelper
    {
        $helperPath = config('measurementUnits.helpers.' . $measurementUnit->getBaseMeasurementUnitHelper());

        $helper = new $helperPath();
        $helper->setMeasurementUnitModel($measurementUnit);

        return $helper;
    }
}