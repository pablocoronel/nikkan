<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeccionContactoMapa extends Model
{
    //
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'seccion_contacto_mapas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['codigo'];
}
