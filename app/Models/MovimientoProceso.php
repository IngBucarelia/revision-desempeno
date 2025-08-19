<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovimientoProceso extends Model {


    protected $movimineto_proceso = 'movimiento_proceso';
    use HasFactory;

    protected $fillable = ['proceso_id', 'usuario_id','codigo_proceso' ,'accion', 'fecha_hora'];

    public function proceso() {
        return $this->belongsTo(FaltaDisciplinaria::class, 'proceso_id');
    }

    public function usuario() {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
