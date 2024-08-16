<?php

namespace IlBronza\MeasurementUnits\BaseMeasurementUnitHelpers\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

use function json_encode;

trait MeasurementUnitDatesMethodsTrait
{
	public function parseMeasurementUnitOutputValue(mixed $value) : mixed
	{		
		$validator = Validator::make(
			['value' => $value],
			['value' => 'date']
		);

		if(! $validator->passes())
			throw new \Exception('Value is not a valid date: ' . json_encode($value), config('app.ibValidationError', 9901));

		return Carbon::parse($value);
	}

	protected function validateInputs($value, $amount) : \Exception|true
	{
		if(! is_numeric($amount))
			throw new \Exception('Valore non processabile, amount non è numerico : ' . json_encode($amount) . ' ' . gettype($amount));

		if(! $value instanceof Carbon)
			throw new \Exception('Valore non processabile, non è una Carbon date: ' . json_encode($value) . ' ' . gettype($value));

		return true;
	}
}