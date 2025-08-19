<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Suspension extends Model
{
    use HasFactory;
    protected $table = 'suspensiones';
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
