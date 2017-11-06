<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeccionTiendaCategoria extends Model
{
    //
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'seccion_tienda_categorias';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['fk_familia', 'nombre', 'orden'];
}
