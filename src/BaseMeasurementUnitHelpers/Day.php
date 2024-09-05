<?php

namespace IlBronza\MeasurementUnits\BaseMeasurementUnitHelpers;

use IlBronza\MeasurementUnits\BaseMeasurementUnitHelpers\BaseMeasurementUnitHelper;
use IlBronza\MeasurementUnits\BaseMeasurementUnitHelpers\Traits\MeasurementUnitDatesMethodsTrait;

class Day extends BaseMeasurementUnitHelper
{
	use MeasurementUnitDatesMethodsTrait;

	public function add($value, $amount) : mixed
	{
		$this->validateInputs($value, $amount);

		return $value->copy()
			->addDays(
				floor($amount)
			);
	}

	public function remove($value, $amount) : mixed
	{
		$this->validateInputs($value, $amount);

		return $value->copy()
			->subDays(
				floor($amount)
			);
	}

	public function calculateDifference($start, $end) : mixed
	{
		return  $start->diffInDays($end);
	}
}