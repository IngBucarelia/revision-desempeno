<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banco extends Model
{
    use HasFactory;
    protected $table = 'banco';
    protected $fillable = ['codigo', 'nombre'];

    public function detalles()
    {
        return $this->hasMany(DetalleEmpleado::class, 'banco');
    }
}