<?php

namespace IlBronza\MeasurementUnits\Http\Controllers\MeasurementUnits;

use IlBronza\CRUD\Traits\CRUDCreateStoreTrait;
use IlBronza\CRUD\Traits\CRUDDeleteTrait;
use IlBronza\CRUD\Traits\CRUDEditUpdateTrait;
use IlBronza\CRUD\Traits\CRUDIndexTrait;
use IlBronza\CRUD\Traits\CRUDPlainIndexTrait;
use IlBronza\CRUD\Traits\CRUDRelationshipTrait;
use IlBronza\CRUD\Traits\CRUDShowTrait;
use IlBronza\MeasurementUnits\Http\Controllers\CrudMeasurementUnitCrudController;
use Illuminate\Http\Request;

class MeasurementUnitCrudController extends CrudMeasurementUnitCrudController
{
	use CRUDIndexTrait;
	use CRUDPlainIndexTrait;
    use CRUDCreateStoreTrait;
    use CRUDEditUpdateTrait;
    use CRUDShowTrait;
    use CRUDDeleteTrait;

    use CRUDRelationshipTrait;

    public $configModelClassName = 'measurementUnit';

	public $allowedMethods = [
		'index',
        'create',
        'store',
        'edit',
        'update',
        'show',
        'destroy'
	];

    public function getGenericParametersFile() : ? string
    {
        //MeasurementUnitCreateStoreFieldsetsParameters
        return config($this->getBaseConfigName() . ".models.$this->configModelClassName.parametersFiles.create");
    }

    public function getEditParametersFile() : ? string
    {
        return config($this->getBaseConfigName() . ".models.$this->configModelClassName.parametersFiles.edit");
    }

    public function getIndexFieldsArray()
    {
        return config($this->getBaseConfigName() . ".models.$this->configModelClassName.fieldsGroupsFiles.index")::getFieldsGroup();
    }

    public function getIndexElements()
    {
        return $this->getModelClass()::all();
    }

    public function getRelationshipsManagerClass()
    {
        return config($this->getBaseConfigName() . ".models.{$this->configModelClassName}.relationshipsManagerClasses.show");
    }

    public function show(string $measurementUnit)
    {
        $measurementUnit = $this->findModel($measurementUnit);

        return $this->_show($measurementUnit);
    }

    public function edit(string $measurementUnit)
    {
        $measurementUnit = $this->findModel($measurementUnit);

        return $this->_edit($measurementUnit);
    }

    public function update(Request $request, string $measurementUnit)
    {
        $measurementUnit = $this->findModel($measurementUnit);

        return $this->_update($request, $measurementUnit);
    }

    public function destroy($vehicle)
    {
        $vehicle = $this->findModel($vehicle);

        return $this->_destroy($vehicle);
    }
}