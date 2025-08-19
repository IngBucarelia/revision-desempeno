<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\inasistencia;
use App\Models\Empleado;
use Illuminate\Support\Facades\DB;


class InasistenciasController extends Controller
{
    public function index(Request $request)
        {
            $query = Inasistencia::where('estado', 1); // Solo registros activos

            if ($request->has('search')) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('cedula', 'like', "%$search%")
                    ->orWhere('codigo_falta', 'like', "%$search%")
                    ->orWhere('fecha_inicio', 'like', "%$search%")
                    ->orWhere('fecha_fin', 'like', "%$search%");
                });
            }

            $inasistencias = $query->paginate(10);

            if ($request->ajax()) {
                return view('inasistencias.index', compact('inasistencias'));
            }

            return view('inasistencias.index', compact('inasistencias'));
        }

    public function create()
    {
        $empleados = Empleado::all(); // Para el selector de cédulas
        return view('inasistencias.create', compact('empleados'));
    }

    
    public function store(Request $request)
        {
            $validatedData = $request->validate([
                'cedula' => [
                    'required',
                    function ($attribute, $value, $fail) {
                        $empleado = DB::table('empleados')->where('codigo', $value)->first();
                        if (!$empleado) {
                            $fail('El empleado con cédula ' . $value . ' no está registrado.');
                        }
                    }
                ],
                'codigo_falta' => 'nullable|string',
                'fecha_registro' => 'required|date',
                'fecha_inicio' => 'required|date|before_or_equal:fecha_fin',
                'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
                'total_dias' => 'required|integer|min:1',
            ], [
                'fecha_inicio.before_or_equal' => 'La fecha de inicio debe ser anterior o igual a la fecha fin.',
                'fecha_fin.after_or_equal' => 'La fecha fin debe ser posterior o igual a la fecha inicio.',
                'total_dias.min' => 'El total de días debe ser al menos 1.',
            ]);

            try {
                Inasistencia::create($validatedData);
                return redirect()->route('inasistencias.index')->with('success', 'Inasistencia registrada.');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Error al guardar: ' . $e->getMessage())->withInput();
            }
        }



    public function destroy($id)
        {
            $inasistencia = Inasistencia::findOrFail($id);
            $inasistencia->estado = 0;
            $inasistencia->save();

            return redirect()->route('inasistencias.index')->with('success', 'Inasistencia eliminada correctamente.');
        }

    public function buscarPorCedula($cedula)
    {
        $inasistencias = \App\Models\inasistencia::where('cedula', $cedula);

        if ($inasistencias->count() > 0) {
            return response()->json([
                'status' => 'found',
                'total' => $inasistencias->count(),
                'ultima_fecha' => $inasistencias->first()->vence_prorroga,
                'detalle_url' => url("/inasistencias/detalle/{$cedula}")
            ]);
        } else {
            return response()->json(['status' => 'not_found']);
        }
    }

    public function detalle($cedula)
    {
        $empleado = \App\Models\Empleado::where('codigo', $cedula)->first();
        $inasistencias = \App\Models\inasistencia::where('cedula', $cedula);

        return view('inasistencias.detalle', compact('empleado', 'inasistencias'));
    }


    public function buscarFaltasDisciplinarias($cedula)
    {
        $faltas = DB::table('faltas_disciplinarias')
                    ->where('numero_documento_trabajador', $cedula)
                    ->where('clase_falta', 'inasistencia')
                    ->select('id', 'descripcion_falta','fecha_reporte')
                    ->get();

        return response()->json($faltas);
    }
}
