<?php

namespace IlBronza\MeasurementUnits\Http\Controllers\Providers\Fieldsets;

use IlBronza\Form\Helpers\FieldsetsProvider\FieldsetParametersFile;

class MeasurementUnitEditUpdateFieldsetsParameters extends FieldsetParametersFile
{
    public function _getFieldsetsParameters() : array
    {
        return [
            'package' => [
                'fields' => [
                    'name' => ['text' => 'string|required'],
                    'description' => ['text' => 'string|nullable|max:255'],
                ],
                'width' => ["1-3@l", '1-2@m']
            ]
        ];
    }
}
