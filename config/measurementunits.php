<?php

use App\Models\ProjectSpecific\User;
use IlBronza\MeasurementUnits\BaseMeasurementUnits\CubicCm;
use IlBronza\MeasurementUnits\BaseMeasurementUnits\Day;
use IlBronza\MeasurementUnits\BaseMeasurementUnits\Gram;
use IlBronza\MeasurementUnits\BaseMeasurementUnits\Meter;
use IlBronza\MeasurementUnits\BaseMeasurementUnits\Second;
use IlBronza\MeasurementUnits\BaseMeasurementUnits\SquareMeter;
use IlBronza\MeasurementUnits\Http\Controllers\MeasurementUnits\MeasurementUnitCrudController;
use IlBronza\MeasurementUnits\Http\Controllers\Providers\FieldsGroups\MeasurementUnitFieldsGroupParametersFile;
use IlBronza\MeasurementUnits\Http\Controllers\Providers\Fieldsets\MeasurementUnitCreateStoreFieldsetsParameters;
use IlBronza\MeasurementUnits\Http\Controllers\Providers\Fieldsets\MeasurementUnitEditUpdateFieldsetsParameters;
use IlBronza\MeasurementUnits\Http\Controllers\Providers\RelationshipsManagers\MeasurementUnitRelationManager;
use IlBronza\MeasurementUnits\Models\MeasurementUnit;
use IlBronza\Vehicles\Models\Vehicle;

return [
    'routePrefix' => 'measurementUnits.',

    'applicableTo' => [
        User::class => 'users',
        Vehicle::class => 'vehicles'
    ],

    'helpers' => [
        'Meter' => Meter::class,
        'CubicCm' => CubicCm::class,
        'Day' => Day::class,
        'Gram' => Gram::class,
        'Second' => Second::class,
        'SquareMeter' => SquareMeter::class,
    ],

    'models' => [
        'measurementUnit' => [
            'class' => MeasurementUnit::class,
            'table' => 'measurement_units__measurement_units',
            'fieldsGroupsFiles' => [
                'index' => MeasurementUnitFieldsGroupParametersFile::class
            ],
            'relationshipsManagerClasses' => [
                'show' => MeasurementUnitRelationManager::class
            ],
            'parametersFiles' => [
                'create' => MeasurementUnitCreateStoreFieldsetsParameters::class,
                'edit' => MeasurementUnitEditUpdateFieldsetsParameters::class
            ],
            'controllers' => [
                'index' => MeasurementUnitCrudController::class,
                'create' => MeasurementUnitCrudController::class,
                'store' => MeasurementUnitCrudController::class,
                'show' => MeasurementUnitCrudController::class,
                'edit' => MeasurementUnitCrudController::class,
                'update' => MeasurementUnitCrudController::class,
                'destroy' => MeasurementUnitCrudController::class,
            ]
        ]
    ]
];