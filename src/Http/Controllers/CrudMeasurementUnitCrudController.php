<?php

namespace IlBronza\MeasurementUnits\Http\Controllers;

use IlBronza\CRUD\CRUD;
use IlBronza\MeasurementUnits\Models\MeasurementUnit;

class CrudMeasurementUnitCrudController extends CRUD
{
    public function getBaseConfigName()
    {
        return 'measurementUnits';
    }

    public function getRouteBaseNamePrefix() : ? string
    {
        return config($this->getBaseConfigName() . ".routePrefix");
    }

    public function setModelClass()
    {
        $this->modelClass = config($this->getBaseConfigName() . ".models.{$this->configModelClassName}.class");
    }
}