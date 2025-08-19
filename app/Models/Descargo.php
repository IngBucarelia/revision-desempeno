<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Descargo extends Model
{
    use HasFactory;

    protected $fillable = [
        
        'falta_disciplinaria_id',
        'direccion_trabajador',
        'telefono_trabajador',
        'labor',
        'respuesta_1',
        'respuesta_2',
        'respuesta_3',
        'respuesta_4',
        'respuesta_5',
        'respuesta_6',
        'respuesta_7',
        'respuesta_8',
        'respuesta_9',
        'respuesta_10',
        'respuesta_11',
        'respuesta_12',
        'respuesta_13',
        'respuesta_14',
        'respuesta_15',
        'respuesta_16',
        'respuesta_17',
        'respuesta_18',
        'respuesta_19',
        'comentarios',        
        'firma_implicado',
        'firma_responsable',
        
    ];
    public function faltaDisciplinaria()
    {
        return $this->belongsTo(FaltaDisciplinaria::class);
    }
}