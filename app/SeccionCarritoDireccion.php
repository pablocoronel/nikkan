<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeccionCarritoDireccion extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'seccion_carrito_direcciones';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['fk_usuario', 'tipo', 'direccion', 'direccion2', 'codigo_postal', 'ciudad', 'provincia', 'pais', 'telefono_domicilio', 'telefono_celular', 'comentario'];
}
