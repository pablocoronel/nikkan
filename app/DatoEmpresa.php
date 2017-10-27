<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DatoEmpresa extends Model
{
    //
     //
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'dato_empresas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['tipo', 'texto'];
}
