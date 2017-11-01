<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SeccionDocumentoPdf extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'seccion_documento_pdfs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['ruta', 'orden'];
}
