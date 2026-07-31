<?php

namespace IlBronza\MeasurementUnits\Tests\Unit;

use IlBronza\MeasurementUnits\BaseMeasurementUnitHelpers\BaseMeasurementUnitHelper;
use IlBronza\MeasurementUnits\BaseMeasurementUnitHelpers\CubicCm;
use IlBronza\MeasurementUnits\BaseMeasurementUnitHelpers\Gram;
use IlBronza\MeasurementUnits\BaseMeasurementUnitHelpers\Hour;
use IlBronza\MeasurementUnits\BaseMeasurementUnitHelpers\Meter;
use IlBronza\MeasurementUnits\BaseMeasurementUnitHelpers\Second;
use IlBronza\MeasurementUnits\BaseMeasurementUnitHelpers\SquareMeter;
use IlBronza\MeasurementUnits\Tests\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

// unità piatte: quelle che usano MeasurementUnitFlatMethodsTrait,
// dove il valore è un numero e non una data
class FlatMeasurementUnitTest extends TestCase
{
	public static function unitaProvider() : array
	{
		return [
			'Hour' => [Hour::class],
			'Second' => [Second::class],
			'Gram' => [Gram::class],
			'Meter' => [Meter::class],
			'SquareMeter' => [SquareMeter::class],
			'CubicCm' => [CubicCm::class]
		];
	}

	private function helper(string $class) : BaseMeasurementUnitHelper
	{
		return new $class();
	}

	#[DataProvider('unitaProvider')]
	public function testAddSommaLAmount(string $class)
	{
		$this->assertEquals(15, $this->helper($class)->add(10, 5));
	}

	#[DataProvider('unitaProvider')]
	public function testRemoveSottraeLAmount(string $class)
	{
		$this->assertEquals(5, $this->helper($class)->remove(10, 5));
	}

	#[DataProvider('unitaProvider')]
	public function testGestisceIDecimali(string $class)
	{
		$this->assertEquals(2.75, $this->helper($class)->add(2.5, 0.25));
	}

	#[DataProvider('unitaProvider')]
	public function testAccettaStringheNumeriche(string $class)
	{
		$this->assertEquals(15, $this->helper($class)->add('10', '5'));
	}

	#[DataProvider('unitaProvider')]
	public function testParseRestituisceIlValoreInvariato(string $class)
	{
		$this->assertSame(42.5, $this->helper($class)->parseMeasurementUnitOutputValue(42.5));
	}

	#[DataProvider('unitaProvider')]
	public function testCalculateDifference(string $class)
	{
		$this->assertEquals(7, $this->helper($class)->calculateDifference(3, 10));
	}

	#[DataProvider('unitaProvider')]
	public function testCalculateDifferenceNegativaQuandoLaFinePrecedeLInizio(string $class)
	{
		$this->assertEquals(-7, $this->helper($class)->calculateDifference(10, 3));
	}

	#[DataProvider('unitaProvider')]
	public function testAmountNonNumericoLanciaEccezione(string $class)
	{
		$this->expectException(\Exception::class);

		$this->helper($class)->add(10, 'cinque');
	}

	// il trait dichiara di validare anche $value ma controlla due volte $amount:
	// il valore non numerico arriva alla somma e fa esplodere PHP con un TypeError
	// invece dell'eccezione parlante prevista
	#[DataProvider('unitaProvider')]
	public function testValoreNonNumericoLanciaEccezione(string $class)
	{
		$this->expectException(\Exception::class);

		$this->helper($class)->add('dieci', 5);
	}

	// stesso bug, faccia più pericolosa: un valore null non viene intercettato
	// e la somma restituisce silenziosamente l'amount
	#[DataProvider('unitaProvider')]
	public function testValoreNullLanciaEccezione(string $class)
	{
		$this->expectException(\Exception::class);

		$this->helper($class)->add(null, 5);
	}
}
