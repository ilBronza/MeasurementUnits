<?php

namespace IlBronza\MeasurementUnits\Http\Controllers\Providers\Fieldsets;

use IlBronza\Form\Helpers\FieldsetsProvider\FieldsetParametersFile;

class MeasurementUnitCreateStoreFieldsetsParameters extends FieldsetParametersFile
{
    public function _getFieldsetsParameters() : array
    {
        return [
            'package' => [
                'fields' => [
                    'id' => ['text' => 'string|required|max:16'],
                    'name' => ['text' => 'string|required|max:255'],
                    'description' => ['text' => 'string|nullable|max:255'],
                ],
                'width' => ["1-3@l", '1-2@m']
            ]
        ];
    }
}
