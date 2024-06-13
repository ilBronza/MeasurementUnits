<?php

namespace IlBronza\MeasurementUnits\BaseMeasurementUnitHelpers\traits;

trait MeasurementUnitFlatMethodsTrait
{
	public function parseMeasurementUnitOutputValue(mixed $value) : mixed
	{
		return $value;
	}

	protected function validateInputs($value, $amount) : \Exception|true
	{
		if(! is_numeric($amount))
			throw new \Exception('Valore non processabile, amount non è numerico : ' . json_encode($amount) . ' ' . gettype($amount));

		if(! is_numeric($amount))
			throw new \Exception('Valore non processabile, non è un campo numerico: ' . json_encode($value) . ' ' . gettype($value));

		return true;
	}

	public function add($value, $amount) : mixed
	{
		$this->validateInputs($value, $amount);

		return $value + $amount;
	}

	public function remove($value, $amount) : mixed
	{
		$this->validateInputs($value, $amount);

		return $value - $amount;
	}
}