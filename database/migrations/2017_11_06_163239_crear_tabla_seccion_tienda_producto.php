<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaSeccionTiendaProducto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('seccion_tienda_productos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fk_categoria');
            $table->string('nombre');
            $table->string('ruta');
            $table->text('descripcion');
            $table->decimal('precio_original', 8, 2);
            $table->decimal('precio_con_descuento', 8, 2);
            $table->integer('descuento');
            $table->string('coleccion');
            $table->string('guia_de_talle');
            $table->integer('peso');
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
        Schema::drop('seccion_tienda_productos');
    }
}
