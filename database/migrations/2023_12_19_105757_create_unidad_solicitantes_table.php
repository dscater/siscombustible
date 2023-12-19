<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnidadSolicitantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unidad_solicitantes', function (Blueprint $table) {
            $table->id();
            $table->integer("nro");
            $table->string("codigo");
            $table->unsignedBigInteger("unidad_id");
            $table->text("descripcion_viaje");
            $table->date("fecha_solicitud");
            $table->string("nro_hoja_ruta")->nullable();
            $table->integer("conductor");
            $table->integer("vehiculo");
            $table->integer("combustible");
            $table->string("observacion", 700)->nullable();
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
        Schema::dropIfExists('unidad_solicitantes');
    }
}
