<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recordatorio extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo', 'numero_documento_trabajador', 'nombre_trabajador', 
        'clase_falta', 'labor', 'fecha_notificacion', 'fecha_falta', 
        'asunto', 'descripcion_falta', 'observaciones', 'quien_firma', 
        'cargo_firmante'
    ];
}

