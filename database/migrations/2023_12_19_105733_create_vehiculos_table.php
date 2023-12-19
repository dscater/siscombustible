<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->id();
            $table->string("placa");
            $table->string("marca", 255);
            $table->string("clase", 255);
            $table->string("modelo", 255);
            $table->string("procedencia", 255)->nullable();
            $table->string("servicio", 255)->nullable();
            $table->string("traccion", 255)->nullable();
            $table->string("turbo", 255)->nullable();
            $table->string("carroceria", 255)->nullable();
            $table->string("tipo", 255)->nullable();
            $table->string("subtipo", 255)->nullable();
            $table->string("cilindrada", 255)->nullable();
            $table->string("nro_puertas", 255)->nullable();
            $table->string("capacidad_carga", 255)->nullable();
            $table->string("capacidad_plaza", 255)->nullable();
            $table->string("capacidad_arrastre", 255)->nullable();
            $table->string("foto", 255)->nullable();
            $table->string("observacion", 255)->nullable();
            $table->date("fecha_registro");
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
        Schema::dropIfExists('vehiculos');
    }
}
