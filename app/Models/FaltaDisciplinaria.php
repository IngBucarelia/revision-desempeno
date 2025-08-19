<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaltaDisciplinaria extends Model
{
    use HasFactory;
    protected $table = 'faltas_disciplinarias';
    protected $fillable = [
        'codigo',
        'numero_documento_trabajador',
        'nombre_trabajador',
        'tipo_falta',
        'estado',
        'fecha_reporte',
        'hora_reporte',
        'fecha_falta',
        'hora_falta',
        'clase_falta',
        'labor',
        'cantidad',
        'descripcion_falta',
        'nombre_testigo',
        'cargo_testigo',
        'evidencias_adicionales',
        'comentarios_adicionales',
        'comentarios_descargos',
        'comentarios_gestion_humana',
        'compromiso',
        'descargo',
        'fecha_citacion',
        'hora_citacion',
        'apelo',
        'comentario_apelacion',
        'respondio_apelacion',
        'respuesta_apelacion',
        'llamado_atencion',
        'sancion',
        'suspencion',
        'terminacion_contrato',
        'usuario_id',
        'pdf_evidencia',
        'pdf_descargo'
        
    ];
    
   public function descargoDetalles()
        {
            // Ahora, la relación se llama 'descargoDetalles'
            return $this->hasOne(Descargo::class, 'falta_disciplinaria_id');
        }
}


