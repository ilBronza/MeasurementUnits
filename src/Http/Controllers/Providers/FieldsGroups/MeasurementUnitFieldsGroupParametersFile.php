<?php

namespace IlBronza\MeasurementUnits\Http\Controllers\Providers\FieldsGroups;

use IlBronza\Datatables\Providers\FieldsGroupParametersFile;

class MeasurementUnitFieldsGroupParametersFile extends FieldsGroupParametersFile
{
	static function getFieldsGroup() : array
	{
		return [
			'fields' => 
			[
				'mySelfPrimary' => 'primary',
				'mySelfEdit' => 'links.edit',
				'mySelfSee' => 'links.see',


				'id' => 'flat',
				'name' => 'flat',

				'base_measurement_unit' => 'flat',
				'proportion_toward_base_measurement_unit' => 'flat',

				'description' => 'flat',

				'mySelfDelete' => 'links.delete'
			]
		];
	}
}