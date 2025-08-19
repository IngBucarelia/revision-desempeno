<?php

namespace App\Http\Controllers;

use App\Models\ClaseFalta;
use Illuminate\Http\Request;
use App\Models\FaltaDisciplinaria;
use App\Models\Empleado;
use Illuminate\Support\Facades\Log;
use App\Models\MovimientoProceso;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use setasign\Fpdi\Fpdi;
use App\Mail\CustomEmail;



use Illuminate\Support\Facades\Mail;
use App\Mail\FaltaDisciplinariaCreada;
use App\Models\Descargo;
use Illuminate\Support\Facades\DB;

class FaltaDisciplinariaController extends Controller {

    protected $preguntas = [
        1 => "¿Cuál es su fecha de ingreso a la compañía y que cargo desempeña en la actualidad?",
        2 => "¿Conoce usted el Reglamento de Trabajo de Palmas Oleaginosas Bucarelia S.A.S?",
        3 => "¿Conoce sus obligaciones contenidas en el contrato de trabajo?",
        4 => "¿Participo de la jornada de reinducción realizada 20 de Mayo de 2025?",
        5 => "¿Asistió usted a laborar el día 28 de Junio de 2025?",
        6 => "Que labora le fue asignada y en que lote?",
        7 => "Fueron asignadas otras personas a esta labor en el mismo sector?",
        8 => "Sabe usted cuantas personas fueron asignadas a esta labor en este",
        9 => "A qué hora inició a realizar la labor asignada?",
        10 => "Hasta que hora laboró?",
        11 => "Que cantidad de labor realizó?",
        12 => "A que hora abandonó el lugar de trabajo y se desplazó para la muleria?",
        13 => "Porque motivo no continúo realizando la labor asignada?",
        14 => "Tiene usted recomendaciones labores?",
        15 => "Se encontró usted con el supervisor en la muleria?",
        16 => "Se dirigió usted a la enfermería para reportar alguna molestía en su salud?",
        17 => "Sabe cuántas palmas podaron sus compañeros asignados a esta labor",
        18 => "Sabe si alguna otra persona abandonó la ejecución de la labor asignada?",                
        19 => "¿Desea agregar algo más a la presente diligencia o en ejercicio de su derecho a la defensa?"
    ];



    public function index(Request $request)
        {
            $query = $request->input('search');

            $faltas = FaltaDisciplinaria::where('estado', 1) // Solo mostrar activas
                ->when($query, function ($q) use ($query) {
                    $q->where(function ($subquery) use ($query) {
                        $subquery->where('nombre_trabajador', 'LIKE', "%$query%")
                                ->orWhere('numero_documento_trabajador', 'LIKE', "%$query%")
                                ->orWhere('fecha_reporte', 'LIKE', "%$query%")
                                ->orWhere('fecha_falta', 'LIKE', "%$query%")
                                ->orWhere('clase_falta', 'LIKE', "%$query%")
                                ->orWhere('labor', 'LIKE', "%$query%");
                    });
                })
                ->latest()
                ->paginate(5);

            if ($request->ajax()) {
                return view('faltas_disciplinarias.index', compact('faltas'))->render();
            }

            return view('faltas_disciplinarias.index', compact('faltas'));
        }

        public function enDescargos(Request $request)
        {
            $query = $request->input('search');

            $faltas = FaltaDisciplinaria::where('estado', 2) // Solo mostrar activas
                ->when($query, function ($q) use ($query) {
                    $q->where(function ($subquery) use ($query) {
                        $subquery->where('nombre_trabajador', 'LIKE', "%$query%")
                                ->orWhere('numero_documento_trabajador', 'LIKE', "%$query%")
                                ->orWhere('fecha_reporte', 'LIKE', "%$query%")
                                ->orWhere('fecha_falta', 'LIKE', "%$query%")
                                ->orWhere('clase_falta', 'LIKE', "%$query%")
                                ->orWhere('labor', 'LIKE', "%$query%");
                    });
                })
                ->latest()
                ->paginate(5);

            if ($request->ajax()) {
                return view('faltas_disciplinarias.gestionados', compact('faltas'))->render();
            }

            return view('faltas_disciplinarias.gestionados', compact('faltas'));
        }

        public function descargosPresentados(Request $request)
        {
            $query = $request->input('search');

            $faltas = FaltaDisciplinaria::where('estado', 3) // Solo mostrar activas
                ->when($query, function ($q) use ($query) {
                    $q->where(function ($subquery) use ($query) {
                        $subquery->where('nombre_trabajador', 'LIKE', "%$query%")
                                ->orWhere('numero_documento_trabajador', 'LIKE', "%$query%")
                                ->orWhere('fecha_reporte', 'LIKE', "%$query%")
                                ->orWhere('fecha_falta', 'LIKE', "%$query%")
                                ->orWhere('clase_falta', 'LIKE', "%$query%")
                                ->orWhere('labor', 'LIKE', "%$query%");
                    });
                })
                ->latest()
                ->paginate(5);

            if ($request->ajax()) {
                return view('faltas_disciplinarias.descargospresentados', compact('faltas'))->render();
            }

            return view('faltas_disciplinarias.descargospresentados', compact('faltas'));
        }

        public function gestionados(Request $request)
        {
            $query = $request->input('search');

            $faltas = FaltaDisciplinaria::where('estado', 2) // Solo mostrar activas
                ->when($query, function ($q) use ($query) {
                    $q->where(function ($subquery) use ($query) {
                        $subquery->where('nombre_trabajador', 'LIKE', "%$query%")
                                ->orWhere('numero_documento_trabajador', 'LIKE', "%$query%")
                                ->orWhere('fecha_reporte', 'LIKE', "%$query%")
                                ->orWhere('fecha_falta', 'LIKE', "%$query%")
                                ->orWhere('clase_falta', 'LIKE', "%$query%")
                                ->orWhere('labor', 'LIKE', "%$query%");
                    });
                })
                ->latest()
                ->paginate(5);

            if ($request->ajax()) {
                return view('faltas_disciplinarias.gestionados', compact('faltas'))->render();
            }

            return view('faltas_disciplinarias.gestionados', compact('faltas'));
        }

        public function pordesicion(Request $request)
        {
            $query = $request->input('search');

            $faltas = FaltaDisciplinaria::where('estado', 3) // Solo mostrar activas
                ->when($query, function ($q) use ($query) {
                    $q->where(function ($subquery) use ($query) {
                        $subquery->where('nombre_trabajador', 'LIKE', "%$query%")
                                ->orWhere('numero_documento_trabajador', 'LIKE', "%$query%")
                                ->orWhere('fecha_reporte', 'LIKE', "%$query%")
                                ->orWhere('fecha_falta', 'LIKE', "%$query%")
                                ->orWhere('clase_falta', 'LIKE', "%$query%")
                                ->orWhere('labor', 'LIKE', "%$query%");
                    });
                })
                ->latest()
                ->paginate(5);

            if ($request->ajax()) {
                return view('faltas_disciplinarias.decidir', compact('faltas'))->render();
            }

            return view('faltas_disciplinarias.decidir', compact('faltas'));
        }


        public function primeraDesicion(Request $request)
        {
            $query = $request->input('search');

            $faltas = FaltaDisciplinaria::where('estado', 4) // Solo mostrar activas
                ->when($query, function ($q) use ($query) {
                    $q->where(function ($subquery) use ($query) {
                        $subquery->where('nombre_trabajador', 'LIKE', "%$query%")
                                ->orWhere('numero_documento_trabajador', 'LIKE', "%$query%")
                                ->orWhere('fecha_reporte', 'LIKE', "%$query%")
                                ->orWhere('fecha_falta', 'LIKE', "%$query%")
                                ->orWhere('clase_falta', 'LIKE', "%$query%")
                                ->orWhere('labor', 'LIKE', "%$query%");
                    });
                })
                ->latest()
                ->paginate(5);

            if ($request->ajax()) {
                return view('faltas_disciplinarias.primeradesicion', compact('faltas'))->render();
            }

            return view('faltas_disciplinarias.primeradesicion', compact('faltas'));
        }

        public function yadecidido(Request $request)
        {
            $query = $request->input('search');

            $faltas = FaltaDisciplinaria::where('estado', 6) // Solo mostrar activas
                ->when($query, function ($q) use ($query) {
                    $q->where(function ($subquery) use ($query) {
                        $subquery->where('nombre_trabajador', 'LIKE', "%$query%")
                                ->orWhere('numero_documento_trabajador', 'LIKE', "%$query%")
                                ->orWhere('fecha_reporte', 'LIKE', "%$query%")
                                ->orWhere('fecha_falta', 'LIKE', "%$query%")
                                ->orWhere('clase_falta', 'LIKE', "%$query%")
                                ->orWhere('labor', 'LIKE', "%$query%");
                    });
                })
                ->latest()
                ->paginate(5);

            if ($request->ajax()) {
                return view('faltas_disciplinarias.terminado', compact('faltas'))->render();
            }

            return view('faltas_disciplinarias.terminado', compact('faltas'));
        }

        public function apelacion(Request $request)
        {
            $query = $request->input('search');

            $faltas = FaltaDisciplinaria::where('estado', 5) // Solo mostrar activas
                ->when($query, function ($q) use ($query) {
                    $q->where(function ($subquery) use ($query) {
                        $subquery->where('nombre_trabajador', 'LIKE', "%$query%")
                                ->orWhere('numero_documento_trabajador', 'LIKE', "%$query%")
                                ->orWhere('fecha_reporte', 'LIKE', "%$query%")
                                ->orWhere('fecha_falta', 'LIKE', "%$query%")
                                ->orWhere('clase_falta', 'LIKE', "%$query%")
                                ->orWhere('labor', 'LIKE', "%$query%");
                    });
                })
                ->latest()
                ->paginate(5);

            if ($request->ajax()) {
                return view('faltas_disciplinarias.apelacion ', compact('faltas'))->render();
            }

            return view('faltas_disciplinarias.apelacion', compact('faltas'));
        }

        public function descargos(Request $request)
        {
            $query = $request->input('search');

            $faltas = FaltaDisciplinaria::where('estado', 2) // Solo mostrar activas
                ->when($query, function ($q) use ($query) {
                    $q->where(function ($subquery) use ($query) {
                        $subquery->where('nombre_trabajador', 'LIKE', "%$query%")
                                ->orWhere('numero_documento_trabajador', 'LIKE', "%$query%")
                                ->orWhere('fecha_reporte', 'LIKE', "%$query%")
                                ->orWhere('fecha_falta', 'LIKE', "%$query%")
                                ->orWhere('clase_falta', 'LIKE', "%$query%")
                                ->orWhere('labor', 'LIKE', "%$query%");
                    });
                })
                ->latest()
                ->paginate(5);

            if ($request->ajax()) {
                return view('faltas_disciplinarias.descargos', compact('faltas'))->render();
            }

            return view('faltas_disciplinarias.descargos', compact('faltas'));
        }


         public function yaRevisados(Request $request)
        {
            $query = $request->input('search');

            $faltas = FaltaDisciplinaria::where('estado', 2) // Solo mostrar activas
                ->when($query, function ($q) use ($query) {
                    $q->where(function ($subquery) use ($query) {
                        $subquery->where('nombre_trabajador', 'LIKE', "%$query%")
                                ->orWhere('numero_documento_trabajador', 'LIKE', "%$query%")
                                ->orWhere('fecha_reporte', 'LIKE', "%$query%")
                                ->orWhere('fecha_falta', 'LIKE', "%$query%")
                                ->orWhere('clase_falta', 'LIKE', "%$query%")
                                ->orWhere('labor', 'LIKE', "%$query%");
                    });
                })
                ->latest()
                ->paginate(5);

            if ($request->ajax()) {
                return view('faltas_disciplinarias.index', compact('faltas'))->render();
            }

            return view('faltas_disciplinarias.index', compact('faltas'));
        }

    

    public function create() {
        $clasesFalta = ClaseFalta::all();
        return view('faltas_disciplinarias.create', compact('clasesFalta'));
    }
    public function gestionarFase1($id)
    {
        $falta = FaltaDisciplinaria::findOrFail($id); // busca solo la falta que se seleccionó
        return view('faltas_disciplinarias.fase1', compact('falta'));
    }


    public function store(Request $request)
    { 
        try {
            $request->validate([
                'numero_documento_trabajador' => 'required|exists:empleados,codigo',
                'pdf_evidencia' => 'nullable|mimes:pdf|max:2048', // Quitamos "file" para probar
            ]);
            
    
            $empleado = Empleado::where('codigo', $request->numero_documento_trabajador)->first();
    
            if (!$empleado) {
                return redirect()->route('empleados.create')->with('error', 'El número de documento no está registrado. Registre al empleado antes de continuar.');
            }
    
            $data = $request->all();
            //dd($request->all());
            if ($request->hasFile('pdf_evidencia')) {
                $pdf = $request->file('pdf_evidencia');
                $pdfName = time() . '_' . $pdf->getClientOriginalName();
                $pdf->move(public_path('storage/pdfs_faltas'), $pdfName);
                $data['pdf_evidencia'] = 'storage/pdfs_faltas/' . $pdfName; // Ruta pública
            }
           

            $data['usuario_id'] =  Auth::user()->id; // Agregar el usuario autenticado

            $falta = FaltaDisciplinaria::create($data);
            //$correos = ['nromero@bucarelia.com.co','emeneses@bucarelia.com.co'];
            $correos = ['ingdesarrollo@bucarelia.com.co'];
            foreach ($correos as $correo) {
                Mail::to($correo)->send(new FaltaDisciplinariaCreada($falta));
            }

            //creacion del movimiento del proceso 

            $ultimoRegistro = FaltaDisciplinaria::latest('id')->first();

            MovimientoProceso::create([
                'proceso_id' => $ultimoRegistro->id, // Referencia obligatoria al ID
                'codigo_proceso' => $ultimoRegistro->codigo, // Almacena el código de la falta
                'usuario_id' => Auth::id(),
                'accion' => 'Creación',
                'fecha_hora' => Carbon::now(),
            ]);
    
            return redirect()->route('faltas_disciplinarias.index')->with('success', 'Falta disciplinaria registrada correctamente.');
            
        } catch (\Exception $e) {
            Log::error("Error al guardar falta: " . $e->getMessage());
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
    

 
    public function show($id) {
        return view('faltas_disciplinarias.show', ['falta' => FaltaDisciplinaria::findOrFail($id)]);
    }


    



        public function update(Request $request, $id)
    {
        $proceso = FaltaDisciplinaria::findOrFail($id);

        // Solo los campos que esperas actualizar
        $data = $request->only([
            'comentarios_gestion_humana',
            'compromiso',
            'descargo',
            'llamado_atencion',
            'sancion',
            'terminacion_contrato',
            'pdf_evidencia',
            'estado'
        ]);

        // Forzar el estado a 2
        
        // Manejar PDF si se sube
        

        $proceso->update($data);

        MovimientoProceso::create([
            'proceso_id' => $proceso->id,
            'codigo_proceso' => $proceso->codigo,
            'usuario_id' => Auth::id(),
            'accion' => 'Primera Decision',
            'fecha_hora' => \Carbon\Carbon::now(),
        ]);

        return redirect()->route('whatsapp.form')->with('success', 'Proceso actualizado correctamente.');
    }

        // app/Http/Controllers/FaltaDisciplinariaController.php

       public function fase1(Request $request, $id)
        {
            // 1. Validar todos los campos del formulario
            $validated = $request->validate([
                'comentarios_gestion_humana' => 'required|string|max:1000',
                'estado' => 'required',
                // La fecha y hora de citación solo es requerida si el estado es '2'
                'fecha_citacion' => 'required_if:estado,2|nullable|date',
                'hora_citacion' => 'required_if:estado,2|nullable|date_format:H:i',            ]);

            $falta = FaltaDisciplinaria::findOrFail($id);

            // 2. Asignar los valores del request al objeto $falta
            $falta->comentarios_gestion_humana = $validated['comentarios_gestion_humana'];
            $falta->estado = $validated['estado'];

            // 3. Asignar la fecha de citación solo si se seleccionó la opción correspondiente
            if ($validated['estado'] == '2' && isset($validated['fecha_citacion'])) {
                $falta->fecha_citacion = $validated['fecha_citacion'];
                $falta->hora_citacion = $validated['hora_citacion'];
            }

            // Guardar los cambios en la base de datos
            $falta->save();

            // Crear el movimiento del proceso
            $proceso = FaltaDisciplinaria::findOrFail($id);
            MovimientoProceso::create([
                'proceso_id' => $proceso->id,
                'codigo_proceso' => $proceso->codigo,
                'usuario_id' => Auth::id(),
                'accion' => 'Primera Decision',
                'fecha_hora' => \Carbon\Carbon::now(),
            ]);

            // ✅ CORRECCIÓN: Redirigir a una nueva ruta en lugar de retornar la vista directamente
            return redirect()->route('faltas_disciplinarias.aviso', ['id' => $falta->id])->with('success', 'El proceso se ha gestionado con éxito. Ahora puedes enviar el aviso.');
        }

    public function Updatefase2(Request $request, $id)
    {
        $proceso = FaltaDisciplinaria::findOrFail($id);

        $request->validate([
            'comentarios_descargos' => 'required|string|max:3000',
            'pdf_descargo' => 'nullable|file|mimes:pdf|max:20480' // max 20MB
        ]);

        // Actualizar los datos
        $proceso->comentarios_descargos = $request->comentarios_descargos;
        $proceso->estado = 3;

        // Subir el archivo PDF si se adjunta
        if ($request->hasFile('pdf_descargo')) {
            $pdf = $request->file('pdf_descargo');
            $pdfName = time() . '_' . $pdf->getClientOriginalName();
            $pdf->move(public_path('storage/pdfs_faltas'), $pdfName);
            $proceso->pdf_descargo = 'storage/pdfs_faltas/' . $pdfName; // Ruta pública
        }

        $proceso->save();

        // Guardar movimiento
        MovimientoProceso::create([
            'proceso_id' => $proceso->id,
            'codigo_proceso' => $proceso->codigo,
            'usuario_id' => Auth::id(),
            'accion' => 'Descargos Presentados (Fase 2)',
            'fecha_hora' => now(),
        ]);

        return redirect()->route('faltas_disciplinarias.formulario_descargos', [
        'id' => $proceso->id,
        'numero_documento_trabajador' => $proceso->numero_documento_trabajador,
        'nombre_trabajador' => $proceso->nombre_trabajador,
        'fecha_actual' => now()->format('d-m-Y'),
        'hora_actual' => now()->format('h:i A')
    ]);
    }


    

    public function updateFin(Request $request)
    {
            $id = $request->faltas_disciplinaria; // O $request->input('id')

        $proceso = FaltaDisciplinaria::findOrFail($id);

        // Solo los campos que esperas actualizar
        
        $data = $request->only([
            'comentarios_gestion_humana',
            'compromiso',
            'descargo',
            'llamado_atencion',
            'sancion',
            'terminacion_contrato',
            'pdf_evidencia'
        ]);
         $proceso->estado = 4;

        // Forzar el estado a 2
        
        // Manejar PDF si se sube
        

        $proceso->update($data);

        MovimientoProceso::create([
            'proceso_id' => $proceso->id,
            'codigo_proceso' => $proceso->codigo,
            'usuario_id' => Auth::id(),
            'accion' => 'Primera Decision',
            'fecha_hora' => \Carbon\Carbon::now(),
        ]);
         return redirect()->route('faltas_disciplinarias.aviso', ['id' => $id])->with('success', 'El proceso se ha gestionado con éxito. Ahora puedes enviar el aviso.');
    }




    public function apelar(Request $request)
        {
            $id = $request->faltas_disciplinaria; // O $request->input('id')

            $proceso = FaltaDisciplinaria::findOrFail($id);

            // Solo los campos que esperas actualizar
            
            $data = $request->only([
                'apelo',
                'comentario_apelacion',
                
            ]);
            $proceso->estado = 5;

            $proceso->update($data);

            MovimientoProceso::create([
                'proceso_id' => $proceso->id,
                'codigo_proceso' => $proceso->codigo,
                'usuario_id' => Auth::id(),
                'accion' => 'movimiento apelacion',
                'fecha_hora' => \Carbon\Carbon::now(),
            ]);
            return redirect()->route('faltas_disciplinarias.aviso', ['id' => $id])->with('success', 'El proceso se ha gestionado con éxito. Ahora puedes enviar el aviso.');
        }
        
        public function respuestaapelar(Request $request)
        {
            $id = $request->faltas_disciplinaria; // O $request->input('id')

            $proceso = FaltaDisciplinaria::findOrFail($id);

            // Solo los campos que esperas actualizar
            
            $data = $request->only([
                'respondio_apelacion',
                'respuesta_apelacion',
                
            ]);
            $proceso->estado = 6;

            $proceso->update($data);

            MovimientoProceso::create([
                'proceso_id' => $proceso->id,
                'codigo_proceso' => $proceso->codigo,
                'usuario_id' => Auth::id(),
                'accion' => 'movimiento apelacion',
                'fecha_hora' => \Carbon\Carbon::now(),
            ]);
            return redirect()->route('faltas_disciplinarias.aviso', ['id' => $id])->with('success', 'El proceso se ha gestionado con éxito. Ahora puedes enviar el aviso.');
        }


    public function destroy($id)
        {
            // Obtener la falta
            $falta = FaltaDisciplinaria::findOrFail($id);

            // Guardar en el historial de movimientos
            MovimientoProceso::create([
                'proceso_id' => $falta->id,
                'usuario_id' => Auth::id(),
                'codigo_proceso' => $falta->codigo,
                'accion' => 'Desactivación',
                'fecha_hora' => Carbon::now()
            ]);

            // Desactivar la falta en lugar de eliminar
            $falta->estado = 0;
            $falta->save();

            return redirect()->route('faltas_disciplinarias.index')
                            ->with('success', 'Falta disciplinaria desactivada correctamente.');
        }



    public function buscar()
    {
        return view('faltas_disciplinarias.buscar'); // Vista del formulario de búsqueda
    }

    public function buscarproceso(Request $request)
    {   
        $request->validate([
            'documento' => 'required|numeric'
        ]);

        $documento = $request->input('documento');
        $procesos = FaltaDisciplinaria::where('numero_documento_trabajador', $documento)->get();

        return view('faltas_disciplinarias.listado', compact('procesos', 'documento'));
    }

    public function detalle($id)
    {
        $proceso = FaltaDisciplinaria::findOrFail($id);
        return view('faltas_disciplinarias.detalle', compact('proceso'));
    }
    public function Fase2($id)
    {
        $proceso = FaltaDisciplinaria::findOrFail($id);
        return view('faltas_disciplinarias.fase2', compact('proceso'));
    }
     public function Fase0($id)
    {
        $falta = FaltaDisciplinaria::findOrFail($id);
        return view('faltas_disciplinarias.fase1', compact('falta'));
    }
     // En tu controlador FaltaDisciplinariaController

// En tu controlador FaltaDisciplinariaController

public function Tomardesicion($id)
{
    // Usa el nuevo nombre de la relación: 'descargoDetalles'
    $proceso = FaltaDisciplinaria::with('descargoDetalles')->findOrFail($id);
    
    // Si quieres depurar de nuevo, hazlo con el nuevo nombre:
    // dd($proceso->descargoDetalles); 
    
    return view('faltas_disciplinarias.tomardesicion', compact('proceso'));
}

public function Desicionuno($id)
{
    // Usa el nuevo nombre de la relación: 'descargoDetalles'
    $proceso = FaltaDisciplinaria::with('descargoDetalles')->findOrFail($id);
    
    // Si quieres depurar de nuevo, hazlo con el nuevo nombre:
    // dd($proceso->descargoDetalles); 
    
    return view('faltas_disciplinarias.primera_desicion', compact('proceso'));
}

public function enapelacion($id)
{
    // Usa el nuevo nombre de la relación: 'descargoDetalles'
    $proceso = FaltaDisciplinaria::with('descargoDetalles')->findOrFail($id);
    
    // Si quieres depurar de nuevo, hazlo con el nuevo nombre:
    // dd($proceso->descargoDetalles); 
    
    return view('faltas_disciplinarias.enapelacion', compact('proceso'));
}

public function desicionfinal($id)
{
    // Usa el nuevo nombre de la relación: 'descargoDetalles'
    $proceso = FaltaDisciplinaria::with('descargoDetalles')->findOrFail($id);
    
    // Si quieres depurar de nuevo, hazlo con el nuevo nombre:
    // dd($proceso->descargoDetalles); 
    
    return view('faltas_disciplinarias.desicionfinal', compact('proceso'));
}

    //imprimir falta disiciplinaria 
    public function generarPDF($id)
        {
            $proceso = FaltaDisciplinaria::findOrFail($id);

            // 1. Generar PDF desde la vista con DomPDF (sin guardar en disco)
            $dompdf = Pdf::loadView('faltas_disciplinarias.pdf_falta', compact('proceso'))->setPaper('letter', 'portrait');
            $mainPdfContent = $dompdf->output(); // Contenido en memoria

            // 2. Fusionar con FPDI
            $finalPdf = new Fpdi();

            // Cargar PDF generado en memoria
            $mainPdfStream = fopen('php://memory', 'rb+');
            fwrite($mainPdfStream, $mainPdfContent);
            rewind($mainPdfStream);

            $mainPages = $finalPdf->setSourceFile($mainPdfStream);
            for ($i = 1; $i <= $mainPages; $i++) {
                $tplIdx = $finalPdf->importPage($i);
                $finalPdf->AddPage();
                $finalPdf->useTemplate($tplIdx);
            }

            // 3. Agregar la evidencia si existe
            if ($proceso->pdf_evidencia && file_exists(public_path($proceso->pdf_evidencia))) {
                $evidenciaPath = public_path($proceso->pdf_evidencia);
                $eviPages = $finalPdf->setSourceFile($evidenciaPath);
                for ($i = 1; $i <= $eviPages; $i++) {
                    $tplIdx = $finalPdf->importPage($i);
                    $finalPdf->AddPage();
                    $finalPdf->useTemplate($tplIdx);
                }
            }

            // 4. Descargar directamente sin guardar en el servidor
            return response($finalPdf->Output('I', "Falta_{$proceso->codigo}.pdf")) // 'I' = inline en navegador, 'D' = descarga
                ->header('Content-Type', 'application/pdf');
        }

        // envio de noticiaciones por whatsapp 

        public function showForm()
            {
                return view('faltas_disciplinarias.aviso');
            }

            public function sendMessage(Request $request)
            {
                $request->validate([
                    'phone' => 'required|string|min:10',
                    'message' => 'required|string'
                ]);

                $phone = $this->cleanPhoneNumber($request->phone);
                $message = urlencode($request->message);
                
                $whatsappUrl = "https://wa.me/{$phone}?text={$message}";

                return redirect()->away($whatsappUrl);
            }

            private function cleanPhoneNumber($phone)
            {
                // Elimina todo excepto números
                $cleaned = preg_replace('/[^0-9]/', '', $phone);
                
                // Si no tiene código de país, asumimos Venezuela (+58)
                if (strlen($cleaned) === 10 && substr($cleaned, 0, 1) === '4') {
                    $cleaned = '58' . $cleaned;
                }
                
                return $cleaned;
            }

    public function sendEmail(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'message' => 'required|string|max:3000',
            'subject' => 'sometimes|string|max:100'
        ]);

        try {
            Mail::to($validated['email'])
                ->send(new CustomEmail([
                    'email' => $validated['email'],
                    'message' => $validated['message'],
                    'subject' => $validated['subject'] ?? 'Mensaje de ' . config('app.name')
                ]));
        return redirect()->route('faltas_disciplinarias.index') // Cambia esto
               ->with('success', 'Correo de Aviso enviado exitosamente al Correo del Empleado!');

        } catch (\Exception $e) {
            return back()->with('error', 'Error al enviar: ' . $e->getMessage());
        }
    }


    public function mostrarFormularioDescargos($id)
    {
        $proceso = FaltaDisciplinaria::findOrFail($id);
        
        return view('faltas_disciplinarias.formulario_descargos', [
            'proceso' => $proceso,
            'preguntas' => $this->preguntas,
            'fecha_actual' => request('fecha_actual', now()->format('d-m-Y')),
            'hora_actual' => request('hora_actual', now()->format('h:i A'))
        ]);
    }
    

    public function guardarDescargos(Request $request, $id)
        {
            // 1. Preparar reglas de validación
            $reglasValidacion = [
                'direccion' => 'required|string|max:255',
                'labor' => 'required|string|max:255',
                'comentarios' => 'required|string|max:5000',
                'telefono' => 'required|string|max:20',
                'firma_implicado' => 'required|string|max:255',
                'firma_responsable' => 'required|string|max:255'
            ];

            // Agregar validaciones para las 19 respuestas
            for ($i = 1; $i <= 19; $i++) {
                $reglasValidacion['respuesta_' . $i] = 'required|string|max:1000';
            }

            // 2. Validar los datos del formulario
            $datosValidados = $request->validate($reglasValidacion);

            // 3. Preparar los datos para guardar
            $datosDescargo = [
                'direccion_trabajador' => $datosValidados['direccion'],
                 'labor' => $datosValidados['labor'],
                 'comentarios' => $datosValidados['comentarios'],
                'telefono_trabajador' => $datosValidados['telefono'],
                'firma_implicado' => $datosValidados['firma_implicado'],
                'firma_responsable' => $datosValidados['firma_responsable']
            ];

            // Agregar las 19 respuestas
            for ($i = 1; $i <= 19; $i++) {
                $datosDescargo['respuesta_' . $i] = $datosValidados['respuesta_' . $i];
            }

            try {
                DB::beginTransaction();

                // 4. Guardar o actualizar el descargo
                $descargo = Descargo::updateOrCreate(
                    ['falta_disciplinaria_id' => $id],
                    $datosDescargo
                );

                // 5. Actualizar estado de la falta disciplinaria
                FaltaDisciplinaria::where('id', $id)->update(['estado' => 3]);

                // 6. Registrar el movimiento del proceso
                $proceso = FaltaDisciplinaria::find($id);

                MovimientoProceso::create([
                    'proceso_id' => $proceso->id,
                    'codigo_proceso' => $proceso->codigo,
                    'usuario_id' => Auth::id(),
                    'accion' => 'Descargos registrados',
                    'fecha_hora' => now(),
                    'comentarios' => 'Se completó el formulario de descargos'
                ]);

                DB::commit();

                // ✅ Lógica corregida: Llama a la función de PDF
                // con el ID del proceso y el objeto Descargo recién creado.
                return $this->generarPdfDescargosConDatos($id, $descargo);

            } catch (\Exception $e) {
                DB::rollBack();
                Log::error('Error al guardar descargos: ' . $e->getMessage());

                return back()
                    ->withInput()
                    ->with('error', 'Ocurrió un error al guardar los descargos. Por favor intente nuevamente.');
            }
        }


    public function generarPdfDescargosConDatos($id, $descargo)
{
    $proceso = FaltaDisciplinaria::findOrFail($id);

    // ✅ La vista ahora recibe el objeto $descargo directamente
    $pdf = PDF::loadView('faltas_disciplinarias.pdf_descargos', [
        'proceso' => $proceso,
        'descargo' => $descargo, // Pasar el objeto Descargo a la vista
        'preguntas' => $this->preguntas,
        'fecha_actual' => now()->format('d-m-Y'),
        'hora_actual' => now()->format('h:i A')
    ])->setPaper('letter', 'portrait');

    return $pdf->download('acta-descargos-' . $proceso->codigo . '.pdf');
}


      // En tu FaltaDisciplinariaController, agrega este nuevo método
        public function showAviso($id)
        {
            $falta = FaltaDisciplinaria::findOrFail($id);
            $empleado = Empleado::where('codigo', $falta->numero_documento_trabajador)->first();

            return view('faltas_disciplinarias.aviso', [
                'numero_documento' => $falta->numero_documento_trabajador,
                'email' => $empleado->correo ?? null,
                'falta' => $falta,
                'empleado' => $empleado
            ]);
        }

        // En tu controlador FaltaDisciplinariaController
        public function verDescargos($id)
        {
            // ✅ CORRECCIÓN: Se cambió 'descargos' por 'descargo'
            $falta = FaltaDisciplinaria::with('descargoDetalles')->findOrFail($id);

            // ✅ CORRECCIÓN: Se cambió '$falta->descargos' por '$falta->descargo'
            if ($falta->descargoDetalles) {
                $descargo = $falta->descargoDetalles;
                
                // Define las preguntas en un array para un mapeo fácil en la vista
                $preguntas = [
                    'respuesta_1' => '¿Cuál es su fecha de ingreso a la compañía y que cargo desempeña en la actualidad?',
                    'respuesta_2' => '¿Conoce usted el Reglamento de Trabajo de Palmas Oleaginosas Bucarelia S.A.S?',
                    'respuesta_3' => '¿Conoce sus obligaciones contenidas en el contrato de trabajo?',
                    'respuesta_4' => '¿Participo de la jornada de reinducción realizada 20 de Mayo de 2025?',
                    'respuesta_5' => '¿Asistió usted a laborar el día 28 de Junio de 2025?',
                    'respuesta_6' => '¿Que labora le fue asignada y en que lote?',
                    'respuesta_7' => '¿Fueron asignadas otras personas a esta labor en el mismo sector?',
                    'respuesta_8' => '¿Sabe usted cuantas personas fueron asignadas a esta labor en este?',
                    'respuesta_9' => '¿A qué hora inició a realizar la labor asignada?',
                    'respuesta_10' => '¿Hasta que hora laboró?',
                    'respuesta_11' => '¿Que cantidad de labor realizó?',
                    'respuesta_12' => '¿A que hora abandonó el lugar de trabajo y se desplazó para la muleria?',
                    'respuesta_13' => '¿Porque motivo no continúo realizando la labor asignada?',
                    'respuesta_14' => '¿Tiene usted recomendaciones labores?',
                    'respuesta_15' => '¿Se encontró usted con el supervisor en la muleria?',
                    'respuesta_16' => '¿Se dirigió usted a la enfermería para reportar alguna molestía en su salud?',
                    'respuesta_17' => '¿Sabe cuántas palmas podaron sus compañeros asignados a esta labor?',
                    'respuesta_18' => '¿Sabe si alguna otra persona abandonó la ejecución de la labor asignada?',
                    'respuesta_19' => '¿Desea agregar algo más a la presente diligencia o en ejercicio de su derecho a la defensa?',
                ];

                return view('faltas_disciplinarias.ver_descargos', compact('descargo', 'preguntas', 'falta'));
            }

            return back()->with('error', 'No se encontraron descargos para este proceso.');
        }
} 