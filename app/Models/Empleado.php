<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $table = 'empleados';

    protected $fillable = [
        'codigo',
        'nombre',
        'fecha_ingreso',
        'labor',
        'rol',
        'periodo_prueba',
        'numero_contrato',
        'correo',
        'telefono',
        'estado_civil',
        'fecha_terminacion',
        'id_jefe'
    ];


    public function detalle()
    {
        return $this->hasOne(DetalleEmpleado::class, 'empleado_id');
    }

    public function getRouteKeyName()
    {
        return 'codigo';
    }

}
