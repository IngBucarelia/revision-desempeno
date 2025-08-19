<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;


use Illuminate\Database\Eloquent\Model;

class inasistencia extends Model
{
    use HasFactory;

    protected $fillable = [
        'cedula',
        'codigo_falta',
        'fecha_registro',
        'fecha_inicio',
        'fecha_fin',
        'total_dias',
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'cedula', 'codigo');
    }
}
