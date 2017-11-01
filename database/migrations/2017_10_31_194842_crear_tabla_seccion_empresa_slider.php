<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaSeccionEmpresaSlider extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('seccion_empresa_sliders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ruta');
            $table->string('vinculo');
            $table->string('texto');
            $table->string('orden');
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
        //
        Schema::drop('seccion_empresa_sliders');
    }
}
