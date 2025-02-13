<?php

namespace IlBronza\MeasurementUnits\BaseMeasurementUnitHelpers;

use IlBronza\MeasurementUnits\BaseMeasurementUnitHelpers\BaseMeasurementUnitHelper;
use IlBronza\MeasurementUnits\BaseMeasurementUnitHelpers\Traits\MeasurementUnitFlatMethodsTrait;

class Gram extends BaseMeasurementUnitHelper
{
	use MeasurementUnitFlatMethodsTrait;

	public function calculateDifference($start, $end) : mixed
	{
		return $end - $start;
	}
}