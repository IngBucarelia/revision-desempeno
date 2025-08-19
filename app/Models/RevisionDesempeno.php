<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RevisionDesempeno extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha_solicitud',
        'cedula',
        'nombre_trabajador',
        'cargo',
        'fecha_ingreso',
        'prorrogas',
        'fecha_vencimiento',
        'asignado_gh',
        'faltas_disciplinarias',
        'llamados_atencion',
        'sanciones',
        'inasistencias',
        'suspenciones',
        'observaciones_gh',
        'gh_diligenciado_por',
        'gh_firma',
        'gh_fecha',
        'asignado_sst',
        'cumplimiento_sgsst',
        'habitos_comportamientos',
        'sst_diligenciado_por',
        'sst_firma',
        'sst_fecha',
        'jefe',
        'jefe_inmediato',
        'labor_actual',
        'labores_desempenadas',
        'jefe_diligenciado_por',
        'jefe_firma',
        'jefe_fecha',
        'calidad_labor',
        'cumplimiento',
        'productividad',
        'relaciones',
        'otras',
        'gh_cumple',
        'sst_cumple',
        'jefe_cumple',
        'asignado_gerencia',
        'fecha_gerencia',
        'gerencia_cumple',
        'observaciones_gerencia',
        'autorizado_por',
        'firma_autorizado',
        'asignado_elavorado',
        'elaborado_por',
        'revisado_por',
        'aprobado_por',
        'fecha_aprobacion',
        'estado'
    ];

   public function elaborado()
    {
        return $this->belongsTo(\App\Models\Empleado::class, 'elaborado_por', 'id');
    }


    public function revisado()
    {
        return $this->belongsTo(User::class, 'revisado_por');
    }

    public function aprobado() {
        return $this->belongsTo(Empleado::class, 'aprobado_por');
    }

    
}
