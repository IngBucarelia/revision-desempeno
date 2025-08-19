<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntidadCajaComp extends Model
{
    use HasFactory;
    protected $table = 'entidades_caja_comp';
    protected $fillable = ['codigo', 'nombre'];

    public function detalles()
    {
        return $this->hasMany(DetalleEmpleado::class, 'id_entidad_caja_comp');
    }
}
 