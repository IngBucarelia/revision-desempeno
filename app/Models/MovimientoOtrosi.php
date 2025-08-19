<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovimientoOtrosi extends Model
{
    use HasFactory;

    protected $table = 'movimientos_otrosi';

    protected $fillable = [
        'otrosi_id',
        'codigo_otrosi',
        'usuario_id',
        'accion',
        'fecha_hora'
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    public function otrosi()
    {
        return $this->belongsTo(Otrosi::class);
    }
}
