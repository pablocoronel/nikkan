<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeccionTiendaCuponProducto extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'seccion_tienda_cupon_productos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['fk_cupon', 'fk_producto'];
}