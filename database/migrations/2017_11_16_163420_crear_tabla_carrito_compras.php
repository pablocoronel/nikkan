<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaCarritoCompras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('seccion_carrito_compras', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo_compra');
            $table->integer('fk_usuario');
            $table->float('precio_total', 8, 2);
            $table->float('precio_envio', 8, 2);
            $table->string('estado_compra');
            $table->integer('fk_direccion_entrega');
            $table->integer('fk_direccion_facturacion');

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
        Schema::drop('seccion_carrito_compras');
    }
}
