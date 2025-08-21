<?php

namespace IlBronza\MeasurementUnits\Traits;

use IlBronza\MeasurementUnits\Models\MeasurementUnit;

trait InteractsWithMeasurementUnit
{
	public function measurementUnit()
	{
		return $this->belongsTo(MeasurementUnit::getProjectClassName());
	}
}