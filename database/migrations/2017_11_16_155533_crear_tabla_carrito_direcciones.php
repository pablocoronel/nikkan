<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaCarritoDirecciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('seccion_carrito_direcciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fk_usuario');
            $table->string('tipo');
            $table->string('direccion');
            $table->string('direccion2');
            $table->integer('codigo_postal');
            $table->string('ciudad');
            $table->string('provincia');
            $table->string('pais');
            $table->string('telefono_domicilio');
            $table->string('telefono_celular');
            $table->text('comentario');

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
        Schema::drop('seccion_carrito_direcciones');
    }
}
