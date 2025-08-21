<?php

namespace IlBronza\MeasurementUnits\Models;

use IlBronza\CRUD\Models\BaseModel;
use IlBronza\CRUD\Models\PackagedBaseModel;
use IlBronza\CRUD\Traits\Model\CRUDUseUuidTrait;
use Illuminate\Support\Str;

class MeasurementUnitPackageBaseModel extends PackagedBaseModel
{
	use CRUDUseUuidTrait;

	static $packageConfigPrefix = 'measurementUnits';

	protected $keyType = 'string';

	public function getRouteBaseNamePrefix() : ?string
	{
		return config('measurementUnits.routePrefix');
	}

	static function getModelConfigPrefix()
	{
		return static::$modelConfigPrefix ?? Str::camel(class_basename(static::class));
	}

	public function getTable() : string
	{
		return config("measurementUnits.models.{$this->getModelConfigPrefix()}.table");
	}

}