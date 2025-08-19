<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Otrosi extends Model
{
    protected $fillable = [
        'empleado_id',
        'codigo_trabajador',
        'fecha_renovacion',
        'periodo',
        'numero_prorrogas',
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class);
    }
}

