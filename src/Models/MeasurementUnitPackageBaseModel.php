<?php

namespace IlBronza\MeasurementUnits\Models;

use IlBronza\CRUD\Models\BaseModel;
use IlBronza\CRUD\Traits\Model\CRUDUseUuidTrait;
use Illuminate\Support\Str;

class MeasurementUnitPackageBaseModel extends BaseModel
{
	use CRUDUseUuidTrait;

	protected $keyType = 'string';

	public function getRouteBaseNamePrefix() : ?string
	{
		return config('measurementUnits.routePrefix');
	}

	static function getModelConfigPrefix()
	{
		return static::$modelConfigPrefix ?? Str::camel(class_basename(static::class));
	}

	static function getProjectClassName()
	{
		return config('measurementUnits.models.' . static::getModelConfigPrefix() . '.class');
	}

	public function getTable() : string
	{
		return config("measurementUnits.models.{$this->getModelConfigPrefix()}.table");
	}

}