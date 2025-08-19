<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Models\DetalleEmpleado;
use App\Models\EntidadPension;
use App\Models\EntidadEps;
use App\Models\EntidadCesantias;
use App\Models\EntidadCajaComp;
use App\Models\EntidadArp;
use App\Models\Banco;
use Illuminate\Support\Facades\Auth;

class EmpleadoController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');

        $empleados = Empleado::where('estado', 1) // Mostrar solo activos
            ->when($query, function ($q) use ($query) {
                $q->where('nombre', 'LIKE', "%$query%")
                ->orWhere('correo', 'LIKE', "%$query%")
                ->orWhere('codigo', 'LIKE', "%$query%")
                ->orWhere('telefono', 'LIKE', "%$query%");
            })
            ->latest()
            ->paginate(7);

        if ($request->ajax()) {
            return view('empleados.index', compact('empleados'))->render();
        }

        return view('empleados.index', compact('empleados'));
    }

    public function create()
    {
        $empleados = Empleado::where('rol', 'jefe_inmediato')->get();
        return view('empleados.create', compact('empleados'));
    }

    public function store(Request $request)
    {

        
        $request->validate([
            'codigo' => 'required|unique:empleados',
            'nombre' => 'required|string|max:255',
            'fecha_ingreso' => 'required|date',
            'periodo_prueba' => 'required|string|max:20',            
            'numero_contrato' => 'required|string|max:50',
            'correo' => 'required|email|unique:empleados',
            'telefono' => 'required|string|max:20',
            'labor' => 'required|string|max:50',
            'estado_civil' => 'required|string|max:20',
            'fecha_ingreso' => 'required|date',
            'id_jefe' => 'required|string|max:50',
            'estado' => 'required|string|max:50',
        ]);

        Empleado::create($request->all());

        return redirect()->route('empleados.create')->with('success', 'Empleado registrado correctamente.');
    }
    public function edit($id)
    {
        $empleado = Empleado::findOrFail($id);

        // Incluye al jefe actual aunque su rol no sea exactamente 'jefe_inmediato'
        $jefe_inmediato = Empleado::where('id', '!=', $empleado->id)
                            ->where(function ($query) use ($empleado) {
                                $query->where('rol', 'jefe_inmediato')
                                    ->orWhere('id', $empleado->id_jefe); // asegurar que esté incluido
                            })
                            ->get();

        return view('empleados.edit', compact('empleado', 'jefe_inmediato'));
    }


    public function update(Request $request, $id)
        {
            $empleado = Empleado::findOrFail($id);
            $empleado->update($request->all());

            return redirect()->route('empleados.index')->with('success', 'Empleado actualizado correctamente');
        }

    public function destroy($id)
    {
        $empleado = Empleado::findOrFail($id);
        $empleado->estado = 0;
        $empleado->save();

        return redirect()->route('empleados.index')->with('success', 'Empleado Eliminado correctamente.');
    }


    public function verDetalle($id)
    {
        $empleado = Empleado::findOrFail($id);
        $detalle = DetalleEmpleado::where('empleado_id', $id)->first();

       

        return view('empleados.detalle', compact('empleado', 'detalle'));
    }


    public function crearDetalle($id)
    {   
        $empleado = Empleado::findOrFail($id);
        $bancos = Banco::all();
        $pensiones = EntidadPension::all();
        $eps = EntidadEps::all();
        $cesantias = EntidadCesantias::all();
        $cajas = EntidadCajaComp::all();
        $arps = EntidadArp::all();
    
        return view('empleados.crear_detalle', compact('empleado', 'bancos', 'pensiones', 'eps', 'cesantias', 'cajas', 'arps'));
    }
    

    public function detalle($id)
    {
        $empleado = Empleado::findOrFail($id);
        $detalle = DetalleEmpleado::where('empleado_id', $id)->first();
    
        // Si $detalle no existe o si sus campos son null, redirigir a la creación
        if (!$detalle || empty($detalle->toArray())) {
            return redirect()->route('empleados.detalle.guardar', $id);
        }
    
        return view('empleados.detalle', compact('empleado', 'detalle'));
    }

    public function mostrarFormularioDetalle($id)
    {
        // Obtener el empleado para mostrar su información básica
        $empleado = Empleado::findOrFail($id);
        
        return view('empleados.crear_detalle', compact('empleado'));
    }

    public function guardarDetalle(Request $request, $id)
    {
        // Validar datos
        $request->validate([
            'id_entidad_pension' => 'required',
            'id_entidad_eps' => 'required',
            'id_entidad_cesantias' => 'required',
            'id_entidad_caja_comp' => 'required',
            'id_entidad_arp' => 'required',
            'fecha_ingreso_ley50' => 'required|date',
            'fecha_prima_hasta' => 'required|date',
            'fecha_vacaciones_hasta' => 'required|date',
            'fecha_ultimo_aumento' => 'required|date',
            'fecha_ultimas_vacaciones' => 'required|date',
            'fecha_ultima_pension' => 'required|date',
            'cuenta_bancaria' => 'required',
            'id_banco' => 'required',
            'indicador_forma_pago' => 'required',
            'direccion' => 'required',
            'fecha_nacimiento' => 'required|date',
            'lugar_nacimiento' => 'required',
            'camisa' => 'required',
            'pantalon' => 'required',
            'zapatos' => 'required',
        ]);

        // Guardar los datos en la tabla `detalle_empleado`
        DetalleEmpleado::create([
            'empleado_id' => $id,
            'id_entidad_pension' => $request->id_entidad_pension,
            'id_entidad_eps' => $request->id_entidad_eps,
            'id_entidad_cesantias' => $request->id_entidad_cesantias,
            'id_entidad_caja_comp' => $request->id_entidad_caja_comp,
            'id_entidad_arp' => $request->id_entidad_arp,
            'fecha_ingreso_ley50' => $request->fecha_ingreso_ley50,
            'fecha_prima_hasta' => $request->fecha_prima_hasta,
            'fecha_vacaciones_hasta' => $request->fecha_vacaciones_hasta,
            'fecha_ultimo_aumento' => $request->fecha_ultimo_aumento,
            'fecha_ultimas_vacaciones' => $request->fecha_ultimas_vacaciones,
            'fecha_ultima_pension' => $request->fecha_ultima_pension,
            'cuenta_bancaria' => $request->cuenta_bancaria,
            'id_banco' => $request->id_banco,
            'indicador_forma_pago' => $request->indicador_forma_pago,
            'direccion' => $request->direccion,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'lugar_nacimiento' => $request->lugar_nacimiento,
            'camisa' => $request->camisa,
            'pantalon' => $request->pantalon,
            'zapatos' => $request->zapatos,
        ]);

        // Redirigir a la vista de detalles
        return redirect()->route('empleados.detalle', $id)->with('success', 'Información guardada correctamente');
    }

        
    public function show($id)
    {
        return redirect()->route('empleados.index');
    }



    public function buscarPorDocumento($documento)
    {
        $empleado = Empleado::where('codigo', $documento)->first();

        if ($empleado) {
            return response()->json([
                'status' => 'found',
                'empleado' => $empleado
            ]);
        } else {
            return response()->json(['status' => 'not_found']);
        }
    }


    //mostrar informacion del empleado 

    public function miPerfil()
    {
        $usuario = Auth::user();

        // Buscar el empleado asociado por el campo `codigo` que sea igual a la cédula del usuario
        $empleado = Empleado::where('codigo', $usuario->cedula)->first();

        if (!$empleado) {
            return back()->with('error', 'No se encontró información del empleado asociado.');
        }

        $codigo = $empleado->codigo;

        $llamados = \App\Models\LlamadoAtencion::where('documento', $codigo)->get();
        $faltas = \App\Models\FaltaDisciplinaria::where('numero_documento_trabajador', $codigo)->get();
        $suspenciones = \App\Models\Suspension::where('cedula', $codigo)->get();
        $sanciones = \App\Models\Inasistencia::where('cedula', $codigo)->get(); // ajusta si manejas sanciones diferente

        return view('empleados.perfil', compact('empleado', 'llamados', 'faltas', 'suspenciones', 'sanciones'));
    }

    public function detalleEmpleado($id)
    {
        $empleado = Empleado::findOrFail($id);

        $llamados = \App\Models\LlamadoAtencion::where('documento', $empleado->codigo)
              ->where('estado', 1)
              ->orderBy('created_at', 'desc')
              ->get();

        $faltas = \App\Models\FaltaDisciplinaria::where('numero_documento_trabajador', $empleado->codigo)
        ->where('estado', 1)
        ->orderBy('created_at', 'desc')
        ->get();
        $sanciones = \App\Models\Suspension::where('codigo_falta', function($query) use ($empleado) {
            $query->select('id')
                ->from('faltas_disciplinarias')
                ->where('numero_documento_trabajador', $empleado->codigo)
                ->where('sancion', 1);
        })->get();

        $suspenciones = \App\Models\Suspension::where('cedula', $empleado->codigo)->get();

        return view('empleados.detalle_general', compact('empleado', 'llamados', 'faltas', 'sanciones', 'suspenciones'));
    }

    public function empleadosPorRol()
        {
            $empleadosPorRol = \App\Models\Empleado::orderBy('rol')->get()->groupBy('rol');
            return view('empleados.por_rol', compact('empleadosPorRol'));
        }



    

}
