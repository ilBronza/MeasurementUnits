<?php

namespace IlBronza\MeasurementUnits\Tests\Unit;

use Carbon\Carbon;
use IlBronza\MeasurementUnits\BaseMeasurementUnitHelpers\Year;
use IlBronza\MeasurementUnits\Tests\TestCase;

class YearTest extends TestCase
{
	private function helper() : Year
	{
		return new Year();
	}

	public function testAddSommaGliAnniInteri()
	{
		$data = Carbon::parse('2020-01-01');

		$this->assertEquals('2022-01-01', $this->helper()->add($data, 2)->toDateString());
	}

	// mezzo anno = floor(365 * 0.5) = 182 giorni, sommati prima degli anni
	public function testAddSpezzaIDecimaliInGiorni()
	{
		$data = Carbon::parse('2020-01-01');

		$this->assertEquals('2021-07-01', $this->helper()->add($data, 1.5)->toDateString());
	}

	public function testRemoveSottraeAnniEGiorni()
	{
		$data = Carbon::parse('2021-07-01');

		$this->assertEquals('2020-01-01', $this->helper()->remove($data, 1.5)->toDateString());
	}

	public function testNonMutaLaDataDiPartenza()
	{
		$data = Carbon::parse('2020-01-01');

		$this->helper()->add($data, 2);

		$this->assertEquals('2020-01-01', $data->toDateString());
	}

	public function testCalculateDifferenceSuAnniInteri()
	{
		$inizio = Carbon::parse('2020-01-01');
		$fine = Carbon::parse('2023-01-01');

		$this->assertEquals(3, $this->helper()->calculateDifference($inizio, $fine));
	}

	public function testCalculateDifferenceNegativaQuandoLaFinePrecedeLInizio()
	{
		$inizio = Carbon::parse('2027-02-23');
		$fine = Carbon::parse('2026-08-19');

		$this->assertEqualsWithDelta(-188 / 365, $this->helper()->calculateDifference($inizio, $fine), 0.001);
	}

	// il metodo dichiara di calcolare anni interi + resto in giorni/365:
	// 2020-01-01 -> 2021-07-01 sono 1 anno e 182 giorni, cioè 1.4986
	public function testCalculateDifferenceRestituisceIlRestoInFrazioneDiAnno()
	{
		$inizio = Carbon::parse('2020-01-01');
		$fine = Carbon::parse('2021-07-01');

		$this->assertEqualsWithDelta(1 + 182 / 365, $this->helper()->calculateDifference($inizio, $fine), 0.01);
	}

	// add e calculateDifference devono essere l'uno l'inverso dell'altro
	public function testAndataERitorno()
	{
		$inizio = Carbon::parse('2020-01-01');
		$fine = $this->helper()->add($inizio, 2.5);

		$this->assertEqualsWithDelta(2.5, $this->helper()->calculateDifference($inizio, $fine), 0.01);
	}

	public function testValoreNonCarbonLanciaEccezione()
	{
		$this->expectException(\Exception::class);

		$this->helper()->add('2020-01-01', 2);
	}

	public function testAmountNonNumericoLanciaEccezione()
	{
		$this->expectException(\Exception::class);

		$this->helper()->add(Carbon::parse('2020-01-01'), 'due');
	}
}
