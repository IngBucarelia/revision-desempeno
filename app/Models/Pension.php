<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pension extends Model
{
    use HasFactory;
    protected $table = 'entidades_pension';
    protected $fillable = ['codigo', 'nombre'];

    public function detalles()
    {
        return $this->hasMany(DetalleEmpleado::class, 'pensiones');
    }
}