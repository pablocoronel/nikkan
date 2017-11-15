<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeccionTermino extends Model
{
    //
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'seccion_terminos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['texto'];
}
