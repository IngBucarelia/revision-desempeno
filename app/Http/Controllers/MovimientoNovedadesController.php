<?php

namespace App\Http\Controllers;

use App\Models\MovimientoLlamado;
use App\Models\MovimientoNovedades;
use Illuminate\Http\Request;

class MovimientoNovedadesController extends Controller {

    
    public function index(Request $request) {
                $query = $request->input('search');

                $movimientos = \App\Models\MovimientoNovedades::with('usuario')
                    ->when($query, function ($q) use ($query) {
                        $q->where('codigo_llamado', 'LIKE', "%$query%")
                        ->orWhere('accion', 'LIKE', "%$query%")
                        ->orWhereHas('usuario', function ($sub) use ($query) {
                            $sub->where('name', 'LIKE', "%$query%");
                        });
                    })
                    ->latest('fecha_hora')
                    ->paginate(7);

                if ($request->ajax()) {
                    return view('novedades_contrato.movimientos_novedades', compact('movimientos'))->render();
                }

                return view('novedades_contrato.movimientos_novedades', compact('movimientos'));
            }

}
