<?php

namespace IlBronza\MeasurementUnits;

abstract class BaseMeasurementUnit
{
    abstract function getDeadlineValue($initialValue, $validity) : mixed;

    public function getSelectDescriptionString() : string
    {
    	return __('measurementUnits::baseMeasurementUnits.' . class_basename($this)) . ' (' . __('measurementUnits::symbols.' . class_basename($this)) . '): ' . __('measurementUnits::baseMeasurementUnitsCategory.' . class_basename($this));
    }
}