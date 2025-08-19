<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoFalta extends Model
{
    protected $table = 'tipo_faltas';

    protected $fillable = ['nombre'];
}

