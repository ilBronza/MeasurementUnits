<?php

namespace IlBronza\MeasurementUnits\Http\Controllers\Providers\Fieldsets;

use IlBronza\Form\Helpers\FieldsetsProvider\FieldsetParametersFile;

class MeasurementUnitCreateStoreFieldsetsParameters extends FieldsetParametersFile
{
    public function _getFieldsetsParameters() : array
    {
        $possibleValues = app('measurementUnits')->getBaseMeasurementUnitsArray();

        return [
            'base' => [
                'fields' => [
                    'id' => ['text' => 'string|required|max:16'],
                    'name' => ['text' => 'string|required|max:255'],
                    'description' => ['text' => 'string|nullable|max:255'],
                ],
                'width' => ["1-3@l", '1-2@m']
            ],
            'refe' => [
                'fields' => [
                    'base_measurement_unit' => [
                        'type' => 'select',
                        'possibleValuesArray' => $possibleValues,
                        'multiple' => false,
                        'rules' => 'string|nullable|in:' . implode(",", array_keys($possibleValues)),
                    ],

                    'proportion_toward_base_measurement_unit' => ['number' => 'numeric|nullable']
                ]
            ]
        ];
    }
}
