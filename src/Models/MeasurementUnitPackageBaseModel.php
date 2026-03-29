<?php

namespace IlBronza\MeasurementUnits\Models;

use IlBronza\CRUD\Models\BaseModel;
use IlBronza\CRUD\Models\PackagedBaseModel;
use IlBronza\CRUD\Traits\Model\CRUDUseUuidTrait;
use Illuminate\Support\Str;

class MeasurementUnitPackageBaseModel extends PackagedBaseModel
{
	use CRUDUseUuidTrait;

	static $packageConfigPrefix = 'measurementunits';

	protected $keyType = 'string';

	public function getRouteBaseNamePrefix() : ?string
	{
		return config('measurementunits.routePrefix');
	}

	static function getModelConfigPrefix()
	{
		return static::$modelConfigPrefix ?? Str::camel(class_basename(static::class));
	}

	public function getTable() : string
	{
		return config('measurementunits.models.' . $this->getModelConfigPrefix() . '.table');
	}

}