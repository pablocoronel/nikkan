<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CambiarPropidadDeColumnaEnTablaSeccionContactoMapa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('seccion_contacto_mapas', function (Blueprint $table) {
            $table->string('codigo', 500)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('seccion_', function (Blueprint $table) {
            $table->string('codigo', 191)->change();
        });
    }
}
