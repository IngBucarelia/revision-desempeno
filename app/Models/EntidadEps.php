<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntidadEps extends Model
{
    use HasFactory;
    protected $table = 'entidades_eps';
    protected $fillable = ['codigo', 'nombre'];

    public function detalles()
    {
        return $this->hasMany(DetalleEmpleado::class, 'id_entidad_eps');
    }
}

 