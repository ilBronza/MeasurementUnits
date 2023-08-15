<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProportionFieldsToMeasurementUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(config('measurementUnits.models.measurementUnit.table'), function (Blueprint $table) {
            $table->string('base_measurement_unit')->nullable();
            $table->decimal('proportion_toward_base_measurement_unit')->nullable();
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
