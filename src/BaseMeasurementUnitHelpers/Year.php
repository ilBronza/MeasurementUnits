<?php

namespace IlBronza\MeasurementUnits\BaseMeasurementUnitHelpers;

use IlBronza\MeasurementUnits\BaseMeasurementUnitHelpers\Traits\MeasurementUnitDatesMethodsTrait;

class Year extends BaseMeasurementUnitHelper
{
	use MeasurementUnitDatesMethodsTrait;

	private function getDays($amount) : int
	{
		if(($decimal = fmod($amount, 1)) > 0)
			return floor(365 * $decimal);

		return 0;
	}

	private function getYears($amount) : int
	{
		return floor($amount);
	}

	public function add($value, $amount) : mixed
	{
		$this->validateInputs($value, $amount);

		return $value->copy()
			->addDays(
				$this->getDays($amount)
			)->addYears(
				$this->getYears($amount)
			);
	}

	public function remove($value, $amount) : mixed
	{
		$this->validateInputs($value, $amount);

		return $value->copy()
			->subYears(
				$this->getYears($amount)
			)->subDays(
				$this->getDays($amount)
			);
	}

	public function calculateDifference($start, $end) : mixed
	{
		$endPrecedesStart = $end->lt($start);
		$earlier = $endPrecedesStart ? $end : $start;
		$later = $endPrecedesStart ? $start : $end;
		$years = $earlier->diff($later)->y;
		$days = $earlier->copy()->addYears($years)->diffInDays($later, true);
		$difference = $years + $days / 365;

		return $endPrecedesStart ? -$difference : $difference;
	}
}
