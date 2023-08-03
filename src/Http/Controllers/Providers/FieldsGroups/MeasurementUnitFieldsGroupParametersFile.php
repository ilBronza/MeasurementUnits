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
                'description' => 'flat',

                'mySelfDelete' => 'links.delete'
            ]
        ];
	}
}