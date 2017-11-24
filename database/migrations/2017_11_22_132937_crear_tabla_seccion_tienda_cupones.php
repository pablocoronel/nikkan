<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaSeccionTiendaCupones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('seccion_tienda_cupones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo_cupon')->unique();
            $table->date('vigencia_inicio');
            $table->date('vigencia_fin');
            $table->string('tipo_descuento');
            $table->integer('descuento_porcentual')->nullable();
            $table->decimal('descuento_monetario', 8, 2)->nullable();
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
        Schema::drop('seccion_tienda_cupones');
    }
}
