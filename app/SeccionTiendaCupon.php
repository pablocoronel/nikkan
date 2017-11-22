<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeccionTiendaCupon extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'seccion_tienda_cupones';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['codigo_cupon', 'vigencia_inicio', 'vigencia_fin', 'tipo_descuento', 'descuento_porcentual', 'descuento_monetario'];
}
