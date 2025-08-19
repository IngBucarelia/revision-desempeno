<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleEmpleado extends Model
{
    use HasFactory;
    
    protected $table = 'detalle_empleados';
    protected $fillable = [
        'empleado_id', 'id_entidad_pension', 'id_entidad_eps', 'id_entidad_cesantias',
        'id_entidad_caja_comp', 'id_entidad_arp', 'fecha_ingreso_ley50', 'fecha_prima_hasta',
        'fecha_vacaciones_hasta', 'fecha_ultimo_aumento', 'fecha_ultimas_vacaciones',
        'fecha_ultima_pension', 'cuenta_bancaria', 'id_banco', 'indicador_forma_pago',
        'direccion', 'fecha_nacimiento', 'lugar_nacimiento', 'camisa', 'pantalon', 'zapatos'
    ];


    public function banco()
    {
        return $this->belongsTo(Empleado::class, 'id_entidad_banco');
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id');
    }

    
    public function pension()
    {
        return $this->belongsTo(EntidadPension::class, 'id_entidad_pension');
    }

    public function eps()
    {
        return $this->belongsTo(EntidadEps::class, 'id_entidad_eps');
    }

    public function cesantias()
    {
        return $this->belongsTo(EntidadCesantias::class, 'id_entidad_cesantias');
    }

    public function cajaComp()
    {
        return $this->belongsTo(EntidadCajaComp::class, 'id_entidad_caja_comp');
    }

    public function arp()
    {
        return $this->belongsTo(EntidadArp::class, 'id_entidad_arp');
    }
}