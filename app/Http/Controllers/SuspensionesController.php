<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suspension;
use App\Models\Empleado;
use Illuminate\Support\Facades\DB;


class SuspensionesController extends Controller
{
   public function index(Request $request)
        {
            $query = Suspension::where('estado', 1); // Solo suspensiones activas
            
            if ($request->has('search')) {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('cedula', 'like', "%$search%")
                    ->orWhere('codigo_falta', 'like', "%$search%")
                    ->orWhere('fecha_inicio', 'like', "%$search%")
                    ->orWhere('fecha_fin', 'like', "%$search%");
                });
            }

            $suspensiones = $query->paginate(10);

            if ($request->ajax()) {
                return view('suspensiones.partials.table', compact('suspensiones'));
            }

            return view('suspensiones.index', compact('suspensiones'));
        }


    public function create()
    {
        $empleados = Empleado::all(); // Para el selector de cédulas
        return view('suspensiones.create', compact('empleados'));
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
                Suspension::create($validatedData);
                return redirect()->route('suspensiones.index')->with('success', 'suspension registrada.');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Error al guardar: ' . $e->getMessage())->withInput();
            }
        }



    public function destroy($id)
        {
            $suspension = Suspension::findOrFail($id);

            // Registro de auditoría opcional
        

            $suspension->estado = 0;
            $suspension->save();

            return redirect()->route('suspensiones.index')
                            ->with('success', 'Suspensión eliminado correctamente.');
        }

    public function buscarPorCedula($cedula)
    {
        $inasistencias = \App\Models\Suspension::where('cedula', $cedula);

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
        $inasistencias = \App\Models\Suspension::where('cedula', $cedula);

        return view('suspensiones.detalle', compact('empleado', 'suspensiones'));
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

    public function buscarFaltasDisciplinariasSuspenciones($cedula)
    {
        $faltas = DB::table('faltas_disciplinarias')
                    ->where('numero_documento_trabajador', $cedula)
                    ->where('sancion', '1')
                    ->select('id', 'descripcion_falta','fecha_reporte')
                    ->get();

        return response()->json($faltas);
    }


    public function buscar(Request $request)
    {
        $termino = $request->q;
        
        $resultados = Suspension::where('cedula', 'LIKE', "%$termino%")
            ->orWhere('codigo_falta', 'LIKE', "%$termino%")
            ->orWhere('fecha_inicio', 'LIKE', "%$termino%")
            ->orWhere('fecha_fin', 'LIKE', "%$termino%")
            ->get();

        return response()->json($resultados);
    }
}
