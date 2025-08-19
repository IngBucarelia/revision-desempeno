<?php

namespace App\Http\Controllers;

use App\Models\MovimientoProceso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MovimientoProcesoController extends Controller {

    public function index(Request $request) {
        $query = $request->input('search');
    
        $movimientos = MovimientoProceso::with(['proceso', 'usuario'])
            ->when($query, function ($q) use ($query) {
                $q->where('codigo_proceso', 'LIKE', "%$query%")
                ->orWhereHas('usuario', function ($q) use ($query) {
                    $q->where('name', 'LIKE', "%$query%");
                });
            })
            ->latest()
            ->paginate(7); // Se cambia a 10 registros por página
    
        if ($request->ajax()) {
            return view('faltas_disciplinarias.movimientos_faltas', compact('movimientos'))->render();
        }
    
        return view('faltas_disciplinarias.movimientos_faltas', compact('movimientos'));
    }
    

    
}
