<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaRedesSociales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('redes_sociales', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('ubicacion');
            $table->string('vinculo');
            $table->string('ruta');
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
        Schema::drop('redes_sociales');
    }
}
