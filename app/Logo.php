<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logo extends Model
{
    //
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'logos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['tipo', 'ruta'];
}
