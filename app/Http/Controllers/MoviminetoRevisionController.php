<?php

namespace App\Http\Controllers;

use App\Models\MovimientoRevision;
use Illuminate\Http\Request;

class MoviminetoRevisionController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');

        $movimientos = \App\Models\MovimientoRevision::with('usuario')
            ->when($query, function ($q) use ($query) {
                $q->where('codigo_llamado', 'LIKE', "%$query%")
                ->orWhere('accion', 'LIKE', "%$query%")
                ->orWhere('fecha_hora', 'LIKE', "%$query%")
                ->orWhereHas('usuario', function ($sub) use ($query) {
                    $sub->where('name', 'LIKE', "%$query%");
                });
            })
            ->latest('fecha_hora')
            ->paginate(7);

        if ($request->ajax()) {
            return view('revision_desempeno.movimientos_revision', compact('movimientos'))->render();
        }

        return view('revision_desempeno.movimientos_revision', compact('movimientos'));
    }

}
