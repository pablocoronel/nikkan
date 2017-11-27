<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaCarritoArticulosComprados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('seccion_carrito_versiones_compradas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fk_compra');
            $table->integer('fk_version');
            $table->integer('cantidad');
            $table->decimal('precio_final_cupon', 8, 2);
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
        Schema::drop('seccion_carrito_versiones_compradas');
    }
}
