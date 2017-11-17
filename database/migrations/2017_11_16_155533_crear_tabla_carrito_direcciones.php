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
            $table->string('direccion')->nullable();
            $table->string('direccion2')->nullable();
            $table->integer('codigo_postal');
            $table->string('ciudad');
            $table->string('provincia');
            $table->string('pais');
            $table->string('telefono_domicilio')->nullable();
            $table->string('telefono_celular')->nullable();
            $table->text('comentario')->nullable();

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
