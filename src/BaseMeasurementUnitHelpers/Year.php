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
			->subDays(
				$this->getDays($amount)
			)->subYears(
				$this->getYears($amount)
			);
	}
}