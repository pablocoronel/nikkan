<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RedesSociales extends Model
{
    //
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'redes_sociales';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre', 'ubicacion', 'vinculo', 'ruta', 'orden'];
}
