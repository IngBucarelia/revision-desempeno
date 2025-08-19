<?php
// app/Models/Prorroga.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prorroga extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'cedula',
        'preaviso',
        'fecha_preaviso',
        'inicio_prorroga',
        'vence_prorroga',
        'causa_terminacion_contrato',
    ];
    

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'cedula', 'codigo');
    }
}
