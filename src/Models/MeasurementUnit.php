<?php

namespace IlBronza\MeasurementUnits\Models;

use IlBronza\CRUD\Models\BaseModel;
use IlBronza\CRUD\Traits\CRUDSluggableTrait;
use Illuminate\Support\Str;

class MeasurementUnit extends BaseModel
{
    use CRUDSluggableTrait;

    static $deletingRelationships = [
    ];

    static function getSlugField()
    {
        return "id";
    }

    protected $keyType = 'string';

    public function getRouteBaseNamePrefix() : ? string
    {
        return config('measurementUnits.routePrefix');
    }

    static function getModelConfigPrefix()
    {
        return static::$modelConfigPrefix ?? Str::camel(class_basename(static::class));
    }

    static function getProjectClassName()
    {
        return config("measurementUnits.models.{static::getModelConfigPrefix()}.class");
    }

    public function getTable()
    {
        return config("measurementUnits.models.{$this->getModelConfigPrefix()}.table");
    }    
}