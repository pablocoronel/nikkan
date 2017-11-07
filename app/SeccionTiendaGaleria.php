<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeccionTiendaGaleria extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'seccion_tienda_galerias';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['fk_producto', 'ruta', 'orden'];
}
