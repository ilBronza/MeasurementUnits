<?php

namespace IlBronza\MeasurementUnits\BaseMeasurementUnitHelpers;

use IlBronza\MeasurementUnits\Models\MeasurementUnit;

abstract class BaseMeasurementUnitHelper
{
    public MeasurementUnit $measurementUnit;

    /**
     * this is like a laravel accessor, transform the database value
     * into something readable for the target classes
     * 
     * es. (string) 2021-05-22 10:00:34 becomes Carbon
     * 
     **/
    abstract function parseMeasurementUnitOutputValue(mixed $value) : mixed;

    abstract public function add($source, $amount) : mixed;
    abstract public function remove($source, $amount) : mixed;
    abstract protected function validateInputs($source, $amount) : \Exception|true;

    public function setMeasurementUnitModel(MeasurementUnit $measurementUnit) : static
    {
        $this->measurementUnit = $measurementUnit;

        return $this;
    }

    public function getSelectDescriptionString() : string
    {
    	return __('measurementUnits::BaseMeasurementUnitHelpers.' . class_basename($this)) . ' (' . __('measurementUnits::symbols.' . class_basename($this)) . '): ' . __('measurementUnits::BaseMeasurementUnitHelpersCategory.' . class_basename($this));
    }
}