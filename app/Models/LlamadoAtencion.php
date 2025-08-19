<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LlamadoAtencion extends Model {
    use HasFactory;

    protected $table = 'llamados_atencion';

    protected $fillable = [
        'codigo', 'documento', 'trabajador', 'clase_falta', 'labor',
        'fecha_notificacion', 'fecha_falta', 'asunto', 'descripcion_falta',
        'observaciones','documento_notificacion','nombre_notificacion', 'firma_notificacion', 'cargo',
        'usuario_id','pdf_evidencia'
    ];
}