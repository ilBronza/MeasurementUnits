<?php

namespace IlBronza\MeasurementUnits\Tests\Feature;

use IlBronza\MeasurementUnits\BaseMeasurementUnitHelpers\BaseMeasurementUnitHelper;
use IlBronza\MeasurementUnits\BaseMeasurementUnitHelpers\Day;
use IlBronza\MeasurementUnits\BaseMeasurementUnitHelpers\Gram;
use IlBronza\MeasurementUnits\Helpers\BaseMeasurementUnitCreatorHelper;
use IlBronza\MeasurementUnits\MeasurementUnits;
use IlBronza\MeasurementUnits\Models\MeasurementUnit;
use IlBronza\MeasurementUnits\Tests\TestCase;

class BaseMeasurementUnitHelpersRegistryTest extends TestCase
{
	private function classiSuDisco() : array
	{
		$classi = [];

		foreach(glob(__DIR__ . '/../../src/BaseMeasurementUnitHelpers/*.php') as $file)
		{
			$nome = basename($file, '.php');

			if($nome == 'BaseMeasurementUnitHelper')
				continue;

			$classi[] = $nome;
		}

		sort($classi);

		return $classi;
	}

	public function testTuttiGliHelperSonoIstanziabili()
	{
		foreach($this->classiSuDisco() as $nome)
		{
			$classe = 'IlBronza\MeasurementUnits\BaseMeasurementUnitHelpers\\' . $nome;

			$this->assertInstanceOf(BaseMeasurementUnitHelper::class, new $classe());
		}
	}

	// ogni helper che esiste su disco deve essere raggiungibile da
	// BaseMeasurementUnitCreatorHelper, che lo cerca in config
	public function testOgniHelperSuDiscoEDichiaratoInConfig()
	{
		$dichiarati = array_keys(config('measurementunits.helpers'));

		sort($dichiarati);

		$this->assertEquals($this->classiSuDisco(), $dichiarati);
	}

	public function testOgniClasseDichiarataInConfigEsiste()
	{
		foreach(config('measurementunits.helpers') as $nome => $classe)
			$this->assertTrue(class_exists($classe), $nome . ' punta a una classe inesistente: ' . $classe);
	}

	public function testDayHelperEVieneCreatoTramiteCreator()
	{
		$measurementUnit = new MeasurementUnit();
		$measurementUnit->base_measurement_unit = 'Day';

		$helper = BaseMeasurementUnitCreatorHelper::createHelperByMeasurementUnit($measurementUnit);

		$this->assertInstanceOf(Day::class, $helper);
		$this->assertSame($measurementUnit, $helper->measurementUnit);
	}

	public function testLElencoPerLaSelectContieneTuttiGliHelper()
	{
		$elenco = (new MeasurementUnits())->getBaseMeasurementUnitHelpersArray();

		$this->assertEquals($this->classiSuDisco(), array_keys($elenco));
	}

	public function testLaDescrizionePerLaSelectETradotta()
	{
		$this->assertEquals('Grammo (g): Peso', (new Gram())->getSelectDescriptionString());
	}
}
