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
            $table->string('servicio');
            $table->DATE('fecha');
            $table->TIME('hora_inicio');
            $table->TIME('hora_fin');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('hijos_padres_horas');
    }
}
