<?php

namespace IlBronza\MeasurementUnits\BaseMeasurementUnits;

use IlBronza\MeasurementUnits\BaseMeasurementUnit;

class Meter extends BaseMeasurementUnit
{
	public function getDeadlineValue($initialValue, $validity) : mixed
	{
		return $initialValue + $validity;
	}

	public function getBeforeValue($deadlineValue, $validity)
	{
		return $deadlineValue - $validity;
	}
}