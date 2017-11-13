<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeccionCarritoCompra extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'seccion_carrito_compras';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['fk_version', 'stock_reservado', 'estado_pago'];
}
