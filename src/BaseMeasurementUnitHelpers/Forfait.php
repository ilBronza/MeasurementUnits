<?php

namespace IlBronza\MeasurementUnits\BaseMeasurementUnitHelpers;

use Carbon\Carbon;
use IlBronza\MeasurementUnits\BaseMeasurementUnitHelpers\BaseMeasurementUnitHelper;
use IlBronza\MeasurementUnits\BaseMeasurementUnitHelpers\Traits\MeasurementUnitFlatMethodsTrait;

use Illuminate\Support\Facades\Validator;

use function config;
use function json_encode;

class Forfait extends BaseMeasurementUnitHelper
{
	use MeasurementUnitFlatMethodsTrait;

	public function parseMeasurementUnitOutputValue(mixed $value) : mixed
	{
		$validator = Validator::make(
			['value' => $value],
			['value' => 'numeric']
		);

		if(! $validator->passes())
			throw new \Exception('Value is not a valid float: ' . json_encode($value), config('app.ibValidationError', 9901));

		return (float) $value;
	}

	public function calculateDifference($start, $end) : mixed
	{
		return $end - $start;
	}

}