<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeccionTiendaTalle extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'seccion_tienda_talles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre', 'orden'];
}
