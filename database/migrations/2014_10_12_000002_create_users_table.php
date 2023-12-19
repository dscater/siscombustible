<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('usuario')->unique();
            $table->string("nombre", 255);
            $table->string("paterno", 255);
            $table->string("materno", 255)->nullable();
            $table->string("ci", 100);
            $table->string("ci_exp", 100);
            $table->string("dir", 255)->nullable();
            $table->string("correo", 255)->nullable();
            $table->string("fono", 255);
            $table->string("password", 255);
            $table->enum("tipo", ["ADMINISTRADOR", "DIRECTOR", "ADMINISTRATIVO", "ENCARGADO DE COMBUSTIBLE", "CONDUCTOR"]);
            $table->string("foto", 255)->nullable();
            $table->date("fecha_registro");
            $table->integer("acceso");
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
        Schema::dropIfExists('users');
    }
}
