<?php

namespace IlBronza\MeasurementUnits\Tests;

use IlBronza\MeasurementUnits\MeasurementUnitsServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
	protected function getPackageProviders($app)
	{
		return [
			MeasurementUnitsServiceProvider::class
		];
	}

	protected function defineEnvironment($app)
	{
		$app['config']->set('app.locale', 'it');
	}
}
