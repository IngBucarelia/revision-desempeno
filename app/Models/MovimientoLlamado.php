<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovimientoLlamado extends Model {
    use HasFactory;

    protected $table = 'movimientos_llamados';

    protected $fillable = ['llamado_id', 'usuario_id', 'codigo_llamado', 'accion', 'fecha_hora'];

    public function llamado() {
        return $this->belongsTo(LlamadoAtencion::class, 'llamado_id');
    }

    public function usuario() {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
