<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudCombustiblesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitud_combustibles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("unidad_solicitante_id");
            $table->unsignedBigInteger("user_id")->nullable();
            $table->unsignedBigInteger("vehiculo_id")->nullable();
            $table->double("combustible")->nullable();
            $table->string("nro_vale");
            $table->date("fecha_entrega");
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
        Schema::dropIfExists('solicitud_combustibles');
    }
}
