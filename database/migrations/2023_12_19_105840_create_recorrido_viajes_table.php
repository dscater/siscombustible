<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecorridoViajesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recorrido_viajes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("unidad_solicitante_id");
            $table->text("descripcion_recorrido");
            $table->date("fecha_inicio");
            $table->date("fecha_fin");
            $table->double("inicio_combustible");
            $table->double("fin_combustible");
            $table->double("restante_combustible");
            $table->double("inicio_kilometraje")->nullable();
            $table->double("fin_kilometraje")->nullable();
            $table->string("observacion", 700)->nullable();
            $table->date("fecha_registro");
            $table->timestamps();

            $table->foreign("unidad_solicitante_id")->on("unidad_solicitantes")->references("id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recorrido_viajes');
    }
}
