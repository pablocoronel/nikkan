<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeccionTiendaProducto extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'seccion_tienda_productos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['fk_categoria', 'nombre', 'ruta', 'descripcion', 'precio_original', 'precio_con_descuento', 'descuento','coleccion', 'guia_de_talle', 'orden'];
}
