<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeccionShowroomPortada extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'seccion_showroom_portadas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['ruta', 'texto', 'titulo'];
}
