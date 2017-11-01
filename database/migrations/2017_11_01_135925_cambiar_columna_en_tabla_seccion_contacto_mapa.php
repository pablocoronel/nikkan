<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CambiarColumnaEnTablaSeccionContactoMapa extends Migration
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
            $table->renameColumn('ruta', 'codigo');
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
        Schema::table('seccion_contacto_mapas', function (Blueprint $table) {
            $table->renameColumn('codigo', 'ruta');
        });
    }
}
