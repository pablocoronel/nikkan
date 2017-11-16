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
    protected $fillable = ['codigo_compra', 'fk_usuario', 'precio_total', 'precio_envio', 'estado_compra', 'fk_direccion_entrega', 'fk_direccion_facturacion'];
}
