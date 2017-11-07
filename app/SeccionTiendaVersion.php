<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeccionTiendaVersion extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'seccion_tienda_versiones';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['fk_producto', 'fk_color', 'fk_talle', 'stock'];
}
