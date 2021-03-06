<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaSeccionHomeSlider extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('seccion_home_sliders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ruta');
            $table->string('vinculo');
            $table->text('texto');
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
        Schema::drop('seccion_home_sliders');
    }
}
