<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHorasAcogidaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horas_acogida', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idservicio');
            $table->string('dia_semana');
            $table->TIME('hora_inicio');
            $table->TIME('hora_fin');
            $table->boolean('disponible')->default(true);
            $table->timestamps();
            $table->float('Precio');

            $table->foreign('idservicio')->references('id')->on('servicios');
        });
    }

    public function down()
    {
        Schema::dropIfExists('horas_acogida');
    }
}
