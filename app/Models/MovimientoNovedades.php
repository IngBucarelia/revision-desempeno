<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MovimientoNovedades extends Model {

    use HasFactory;
    protected $table = 'movimientos_novedades';

    protected $fillable = [
        'llamado_id', 'codigo_llamado', 'usuario_id', 'accion', 'fecha_hora'
    ];

    public function usuario() {
        return $this->belongsTo(User::class);
    }
}
