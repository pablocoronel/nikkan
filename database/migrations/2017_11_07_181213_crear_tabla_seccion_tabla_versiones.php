<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaSeccionTablaVersiones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('seccion_tienda_versiones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fk_producto');
            $table->integer('fk_color');
            $table->integer('fk_talle');
            $table->integer('stock');
            $table->string('codigo_producto');
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
        Schema::drop('seccion_tienda_versiones');
    }
}
