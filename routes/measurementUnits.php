<?php

use IlBronza\MeasurementUnits\MeasurementUnits;

Route::group([
	'middleware' => ['web', 'auth'],
	'prefix' => 'measurement-units-management',
	'as' => config('measurementUnits.routePrefix')
	],
	function()
	{
Route::group(['prefix' => 'measurement-units'], function()
{
	Route::get('', [MeasurementUnits::getController('measurementUnit', 'index'), 'index'])->name('measurementUnits.index');
	Route::get('create', [MeasurementUnits::getController('measurementUnit', 'create'), 'create'])->name('measurementUnits.create');
	Route::post('', [MeasurementUnits::getController('measurementUnit', 'store'), 'store'])->name('measurementUnits.store');
	Route::get('{measurementUnit}', [MeasurementUnits::getController('measurementUnit', 'show'), 'show'])->name('measurementUnits.show');
	Route::get('{measurementUnit}/edit', [MeasurementUnits::getController('measurementUnit', 'edit'), 'edit'])->name('measurementUnits.edit');
	Route::put('{measurementUnit}', [MeasurementUnits::getController('measurementUnit', 'edit'), 'update'])->name('measurementUnits.update');
	Route::delete('{measurementUnit}/delete', [MeasurementUnits::getController('measurementUnit', 'destroy'), 'destroy'])->name('measurementUnits.destroy');	
});

	});