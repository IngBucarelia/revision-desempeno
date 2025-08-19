<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\MovimientoNovedades;
use App\Models\NovedadContrato;
use App\Models\Otrosi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;



class NovedadContratoController extends Controller
{
    public function index()
    {
        $novedades = NovedadContrato::latest()->paginate(10);
        return view('novedades_contrato.novedades_contrato', compact('novedades'));
    }

    public function create(Request $request)
        {
            $cedula = $request->get('cedula');

            if (!$cedula) {
                return redirect()->route('novedades.verificarCedula')->with('error', 'Debe ingresar una cédula.');
            }

            $empleado = Empleado::where('codigo', $cedula)->first();
            if (!$empleado) {
                return redirect()->route('novedades.verificarCedula')->with('error', 'El empleado no existe.');
            }

            $otrosi = Otrosi::where('codigo_trabajador', $cedula)->first();
            $novedadExistente = \App\Models\NovedadContrato::where('codigo_trabajador', $cedula)->latest()->first();

            return view('novedades_contrato.create', compact('empleado', 'otrosi', 'novedadExistente'));
        }


    public function store(Request $request)
    {
        $request->validate([
            'fecha_reporte' => 'required|date',
            'tipo_novedad' => 'required|string',
            'nombre_trabajador' => 'required|string',
            'codigo_trabajador' => 'required|string',
            'fecha_novedad' => 'required|date',
            'tipo_contrato' => 'string',
        ]);

        NovedadContrato::create($request->all());


        $ultimoRegistro = NovedadContrato::latest('id')->first();

        MovimientoNovedades::create([
            'llamado_id' => $ultimoRegistro->id,
            'codigo_llamado' => $ultimoRegistro->id, 
            'usuario_id' => Auth::id(),
            'accion' => 'Creación',
            'fecha_hora' => Carbon::now(),
        ]);
        return redirect()->route('novedades_contrato.index')->with('success', 'Novedad registrada.');
    }

    public function edit($id)
    {
        $novedad = NovedadContrato::findOrFail($id);
        return view('novedades_contrato.edit', compact('novedad'));
    }

    public function update(Request $request, $id)
    {
        $novedad = NovedadContrato::findOrFail($id);

        $request->validate([
            'fecha_reporte' => 'required|date',
            'tipo_novedad' => 'required|string',
            'nombre_trabajador' => 'required|string',
            'codigo_trabajador' => 'required|string',
            'fecha_novedad' => 'required|date',
            'tipo_contrato' => 'required|string',
        ]);

        $novedad->update($request->all());
        $ultimoRegistro = NovedadContrato::latest('id')->first();
        MovimientoNovedades::create([
            'llamado_id' => $ultimoRegistro->id,
            'codigo_llamado' => $ultimoRegistro->id, 
            'usuario_id' => Auth::id(),
            'accion' => 'Edición',
            'fecha_hora' => Carbon::now(),
        ]);
        return redirect()->route('novedades_contrato.index')->with('success', 'Novedad actualizada.');
    }

    public function destroy($id)
    {
        $novedad = NovedadContrato::findOrFail($id);
        $novedad->delete();
        $ultimoRegistro = NovedadContrato::latest('id')->first();
        MovimientoNovedades::create([
            'llamado_id' => $ultimoRegistro->id,
            'codigo_llamado' => $ultimoRegistro->id, 
            'usuario_id' => Auth::id(),
            'accion' => 'Eliminación',
            'fecha_hora' => Carbon::now(),
        ]);
        return back()->with('success', 'Novedad eliminada.');

    }

    public function imprimir($id)
    {
        $novedad = NovedadContrato::findOrFail($id);
        $pdf = Pdf::loadView('novedades_contrato.pdf', compact('novedad'));
        return $pdf->stream('novedad_contrato_'.$id.'.pdf');
    }

    public function verDetalle($id)
    {
        $novedad = NovedadContrato::findOrFail($id);
        return view('novedades_contrato.detalle', compact('novedad'));
    }

    public function generarPdf($id)
    {
        $novedad = NovedadContrato::findOrFail($id);
        $pdf = PDF::loadView('novedades_contrato.pdf', compact('novedad'));
        return $pdf->stream('novedad_contrato_'.$novedad->id.'.pdf');
    }




        public function verificarCedula()
    {
        return view('novedades_contrato.verificar_cedula');
    }

    public function buscarOtrosSi(Request $request)
        {
            $cedula = $request->input('cedula');

            $empleado = Empleado::where('codigo', $cedula)->first();

            if (!$empleado) {
                return response()->json([
                    'success' => false,
                    'message' => 'Empleado no encontrado.'
                ]);
            }

            $revision = \App\Models\RevisionDesempeno::where('cedula', $cedula)
                ->where('estado', 'terminado')
                ->latest()
                ->first();

            if ($revision) {
                return response()->json([
                    'success' => true,
                    'data' => [
                        'nombre_trabajador' => $revision->nombre_trabajador,
                        'cedula' => $revision->cedula,
                        'fecha_aprobacion' => $revision->fecha_aprobacion,
                        'estado'=> $revision->estado,
                        'sst_cumple'=> $revision->sst_cumple,
                        'jefe_cumple'=> $revision->jefe_cumple,
                        'gerencia_cumple'=> $revision->gerencia_cumple
                    ]
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Este empleado no tiene evaluación de desempeño terminada. No puede continuar con la Novedad de Contrato.'
                ]);
            }
        }

}

