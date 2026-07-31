<?php

namespace IlBronza\MeasurementUnits\Tests\Unit;

use IlBronza\MeasurementUnits\BaseMeasurementUnitHelpers\Forfait;
use IlBronza\MeasurementUnits\Tests\TestCase;

class ForfaitTest extends TestCase
{
	private function helper() : Forfait
	{
		return new Forfait();
	}

	public function testParseConverteInFloat()
	{
		$risultato = $this->helper()->parseMeasurementUnitOutputValue('12.5');

		$this->assertIsFloat($risultato);
		$this->assertEquals(12.5, $risultato);
	}

	public function testParseConverteAncheGliInteri()
	{
		$risultato = $this->helper()->parseMeasurementUnitOutputValue('12');

		$this->assertIsFloat($risultato);
		$this->assertEquals(12.0, $risultato);
	}

	public function testParseDiUnValoreNonNumericoLanciaEccezione()
	{
		$this->expectException(\Exception::class);

		$this->helper()->parseMeasurementUnitOutputValue('gratis');
	}

	public function testAddERemoveSonoPiatti()
	{
		$this->assertEquals(15, $this->helper()->add(10, 5));
		$this->assertEquals(5, $this->helper()->remove(10, 5));
	}
}
