<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeasurementUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('measurementUnits.models.measurementUnit.table'), function (Blueprint $table) {
            $table->string('id', 16)->primary();

            $table->string('name');
            $table->string('description')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config('measurementUnits.models.measurementUnit.table'));
    }
}
