<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeccionEmpresaSlider extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'seccion_empresa_sliders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['ruta', 'texto', 'vinculo', 'orden'];
}
