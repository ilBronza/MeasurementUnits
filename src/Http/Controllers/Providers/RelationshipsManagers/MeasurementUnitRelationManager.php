<?php

namespace IlBronza\MeasurementUnits\Http\Controllers\Providers\RelationshipsManagers;

use IlBronza\CRUD\Providers\RelationshipsManager\RelationshipsManager;

class MeasurementUnitRelationManager Extends RelationshipsManager
{
	public  function getAllRelationsParameters() : array
	{
		return [
			'show' => [
				'relations' => [
					// 'vehicles' => config('vehicles.models.vehicle.controllers.index')
				]
			]
		];
	}
}