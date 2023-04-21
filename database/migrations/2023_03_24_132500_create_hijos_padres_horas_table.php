<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHijosPadresHorasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hijos_padres_horas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idhijo');
            $table->unsignedBigInteger('idpadre');
            $table->unsignedBigInteger('idhora');

            $table->string('servicio');
            $table->DATE('fecha');
            $table->TIME('hora_inicio');
            $table->TIME('hora_fin');
            $table->timestamps();

            $table->foreign('idhijo')->references('id')->on('hijos');
            $table->foreign('idpadre')->references('id')->on('users');
            $table->foreign('idhora')->references('id')->on('horas_acogida');

        });
    }

    public function down()
    {
        Schema::dropIfExists('hijos_padres_horas');
    }
}
