<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreciosHoraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('precios_hora', function (Blueprint $table) {
            $table->id();
            $table->integer('precio');
            $table->unsignedBigInteger('hora_id');
            $table->timestamps();

            $table->foreign('hora_id')->references('id')->on('hijos_padres_horas');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('precios_hora');
    }
}
