<?php

namespace IlBronza\MeasurementUnits\Tests\Unit;

use Carbon\Carbon;
use IlBronza\MeasurementUnits\BaseMeasurementUnitHelpers\Day;
use IlBronza\MeasurementUnits\Tests\TestCase;

class DayTest extends TestCase
{
	private function helper() : Day
	{
		return new Day();
	}

	public function testAddSommaIGiorni()
	{
		$data = Carbon::parse('2026-01-10');

		$this->assertEquals('2026-01-13', $this->helper()->add($data, 3)->toDateString());
	}

	public function testAddArrotondaPerDifettoIDecimali()
	{
		$data = Carbon::parse('2026-01-10');

		$this->assertEquals('2026-01-12', $this->helper()->add($data, 2.9)->toDateString());
	}

	public function testRemoveSottraeIGiorni()
	{
		$data = Carbon::parse('2026-01-10');

		$this->assertEquals('2026-01-07', $this->helper()->remove($data, 3)->toDateString());
	}

	public function testAddAttraversaIlCambioDiMese()
	{
		$data = Carbon::parse('2026-01-30');

		$this->assertEquals('2026-02-02', $this->helper()->add($data, 3)->toDateString());
	}

	public function testNonMutaLaDataDiPartenza()
	{
		$data = Carbon::parse('2026-01-10');

		$this->helper()->add($data, 3);

		$this->assertEquals('2026-01-10', $data->toDateString());
	}

	public function testCalculateDifference()
	{
		$inizio = Carbon::parse('2026-01-10');
		$fine = Carbon::parse('2026-01-13');

		$this->assertEquals(3, $this->helper()->calculateDifference($inizio, $fine));
	}

	public function testCalculateDifferenceNegativaQuandoLaFinePrecedeLInizio()
	{
		$inizio = Carbon::parse('2026-01-13');
		$fine = Carbon::parse('2026-01-10');

		$this->assertEquals(-3, $this->helper()->calculateDifference($inizio, $fine));
	}

	public function testParseCostruisceUnaCarbon()
	{
		$risultato = $this->helper()->parseMeasurementUnitOutputValue('2026-01-10');

		$this->assertInstanceOf(Carbon::class, $risultato);
		$this->assertEquals('2026-01-10', $risultato->toDateString());
	}

	public function testParseDiUnaDataNonValidaLanciaEccezione()
	{
		$this->expectException(\Exception::class);

		$this->helper()->parseMeasurementUnitOutputValue('non una data');
	}

	public function testValoreNonCarbonLanciaEccezione()
	{
		$this->expectException(\Exception::class);

		$this->helper()->add('2026-01-10', 3);
	}

	public function testAmountNonNumericoLanciaEccezione()
	{
		$this->expectException(\Exception::class);

		$this->helper()->add(Carbon::parse('2026-01-10'), 'tre');
	}
}
