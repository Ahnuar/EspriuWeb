<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHijospadreshorasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hijos_padres_horas', function (Blueprint $table) {
            //
            $table->decimal('Precio', 8, 2)->after('hora_fin')->default(0);
            $table->boolean('casual')->after('Precio')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hijos_padres_horas', function (Blueprint $table) {
            //
        });
    }
}
