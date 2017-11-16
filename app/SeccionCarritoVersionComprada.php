<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeccionCarritoVersionComprada extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'seccion_carrito_versiones_compradas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['fk_compra', 'fk_version', 'cantidad'];
}