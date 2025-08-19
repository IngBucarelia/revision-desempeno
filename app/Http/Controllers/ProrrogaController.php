<?php

// app/Http/Controllers/ProrrogaController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prorroga;
use App\Models\Empleado;

class ProrrogaController extends Controller
{
    public function index()
    {
        $prorrogas = Prorroga::with('empleado')->paginate(10);
        return view('prorrogas.index', compact('prorrogas'));
    }

    public function create()
    {
        $empleados = Empleado::all(); // Para el selector de cédulas
        return view('prorrogas.create', compact('empleados'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cedula' => 'required|exists:empleados,codigo',
            'preaviso' => 'required|boolean',
            'fecha_preaviso' => 'nullable|date',
            'inicio_prorroga' => 'required|date',
            'vence_prorroga' => 'required|date|after_or_equal:inicio_prorroga',
            'causa_terminacion_contrato' => 'nullable|string|max:255',
        ]);

        // Obtener el próximo número secuencial
        $ultimo = Prorroga::latest()->first();
        $numero = $ultimo ? ((int) substr($ultimo->codigo, 4)) + 1 : 1;
        $codigos = 'PRR-' . str_pad($numero, 4, '0', STR_PAD_LEFT);

        // Crear la prórroga
        Prorroga::create([
            'codigo' => $codigos,
            'cedula' => $request->cedula,
            'preaviso' => $request->preaviso,
            'fecha_preaviso' => $request->fecha_preaviso,
            'inicio_prorroga' => $request->inicio_prorroga,
            'vence_prorroga' => $request->vence_prorroga,
            'causa_terminacion_contrato' => $request->causa_terminacion_contrato,
        ]);

        return redirect()->route('prorrogas.index')->with('success', 'Prórroga registrada correctamente.');
    }


    public function destroy(Prorroga $prorroga)
    {
        $prorroga->delete();
        return back()->with('success', 'Prórroga eliminada correctamente.');
    }

    public function buscarPorCedula($cedula)
    {
        $prorrogas = \App\Models\Prorroga::where('cedula', $cedula)->orderBy('vence_prorroga', 'desc')->get();

        if ($prorrogas->count() > 0) {
            return response()->json([
                'status' => 'found',
                'total' => $prorrogas->count(),
                'ultima_fecha' => $prorrogas->first()->vence_prorroga,
                'detalle_url' => url("/prorrogas/detalle/{$cedula}")
            ]);
        } else {
            return response()->json(['status' => 'not_found']);
        }
    }

    public function detalle($cedula)
    {
        $empleado = \App\Models\Empleado::where('codigo', $cedula)->first();
        $prorrogas = \App\Models\Prorroga::where('cedula', $cedula)->orderBy('vence_prorroga', 'desc')->get();

        return view('prorrogas.detalle', compact('empleado', 'prorrogas'));
    }


}
