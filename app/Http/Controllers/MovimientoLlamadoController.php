<?php

namespace App\Http\Controllers;

use App\Models\MovimientoLlamado;
use Illuminate\Http\Request;

class MovimientoLlamadoController extends Controller {

    
    public function index(Request $request) {
        $query = $request->input('search');

        $movimientos = MovimientoLlamado::with(['llamado', 'usuario'])
            ->when($query, function ($q) use ($query) {
                $q->where('codigo_llamado', 'LIKE', "%$query%")
                ->orWhereHas('usuario', function ($q) use ($query) {
                    $q->where('name', 'LIKE', "%$query%");
                });
            })
            ->latest()
            ->paginate(7);

        if ($request->ajax()) {
            return view('llamados_atencion.movimientos_llamados', compact('movimientos'))->render();
        }

        return view('llamados_atencion.movimientos_llamados', compact('movimientos'));
    }
}
