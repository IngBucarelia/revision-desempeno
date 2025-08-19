<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntidadPension extends Model
{
    use HasFactory;
    protected $table = 'entidades_pension';

    public function detalles()
    {
        return $this->hasMany(DetalleEmpleado::class, 'id_entidad_pension');
    }
}

