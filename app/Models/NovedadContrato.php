<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class NovedadContrato extends Model
{
    use HasFactory;
    protected $table = 'novedades_contrato';
    protected $fillable = [
        'fecha_reporte',
        'tipo_novedad',
        'nombre_trabajador',
        'codigo_trabajador',
        'fecha_novedad',
        'tiempo_prorroga',
        'tipo_contrato',
        'observaciones',
        'diligenciado_por',
        'autorizado_por',
    ];
}