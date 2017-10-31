<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeccionHomeDestacado extends Model
{
    //
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'seccion_home_destacados';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['ruta', 'texto', 'vinculo', 'orden'];
}
