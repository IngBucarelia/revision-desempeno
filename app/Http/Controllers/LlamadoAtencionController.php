<?php

namespace App\Http\Controllers;

use App\Models\ClaseFalta;
use Illuminate\Http\Request;
use App\Models\LlamadoAtencion;
use Illuminate\Support\Facades\Storage;
use App\Models\Empleado;
use Illuminate\Support\Facades\Auth;
use App\Models\MovimientoLlamado;
use Barryvdh\DomPDF\Facade\Pdf;
use setasign\Fpdi\Fpdi;
use Carbon\Carbon;




class LlamadoAtencionController extends Controller {
    
   public function index(Request $request)
        {
            $query = $request->input('search');

            $llamados = LlamadoAtencion::where('estado', 1) // ← Filtro constante
                        ->when($query, function ($q) use ($query) {
                            $q->where(function ($subquery) use ($query) {
                                $subquery->where('trabajador', 'LIKE', "%$query%")
                                        ->orWhere('codigo', 'LIKE', "%$query%")
                                        ->orWhere('fecha_notificacion', 'LIKE', "%$query%");
                            });
                        })
                        ->latest('fecha_notificacion')
                        ->paginate(5);

            if ($request->ajax()) {
                return view('llamados_atencion.index', compact('llamados'))->render();
            }

            return view('llamados_atencion.index', compact('llamados'));
        }


    public function create() {
        
        $clasesFalta = ClaseFalta::all();

        return view('llamados_atencion.create', compact('clasesFalta'));
    }

    public function store(Request $request) {
        $request->validate([
            'codigo' => 'required',
            'documento' => 'required',
            'trabajador' => 'required',
            'clase_falta' => 'required',
            'labor' => 'required',
            'fecha_notificacion' => 'required|date',
            'fecha_falta' => 'required|date',
            'asunto' => 'required',
            'descripcion_falta' => 'required',
            'observaciones' => 'nullable', 
            'documento_notificacion' => 'required',
            'nombre_notificacion' => 'required',
            'pdf_evidencia' => 'nullable', // Validar imagen
            'cargo' => 'required',
        ]);

        $empleado = Empleado::where('codigo', $request->documento)->first();
    
            if (!$empleado) {
                return redirect()->route('empleados.create')->with('error', 'El número de documento del empleado no está registrado. Registre al empleado antes de continuar.');
            }

        $empleado2 = Empleado::where('codigo', $request->documento_notificacion)->first();

        if (!$empleado2) {
            return redirect()->route('empleados.create')->with('error', 'El número de documento de quien notifica no está registrado. Registre al empleado antes de continuar.');
        }
        $data = $request->all();

        if ($request->hasFile('pdf_evidencia')) {
            $pdf = $request->file('pdf_evidencia');
            $pdfName = time() . '_' . $pdf->getClientOriginalName();
            $pdf->move(public_path('storage/pdfs_llamados'), $pdfName);
            $data['pdf_evidencia'] = 'storage/pdfs_llamados/' . $pdfName; // Ruta pública
        }

        $data['usuario_id'] = Auth::user()->id;    
        LlamadoAtencion::create($data);

        $ultimoRegistro = LlamadoAtencion::latest('id')->first();

            MovimientoLlamado::create([
                'llamado_id' => $ultimoRegistro->id, // Referencia obligatoria al ID
                'codigo_llamado' => $ultimoRegistro->id, // Almacena el código de la falta
                'usuario_id' => Auth::id(),
                'accion' => 'Creación',
                'fecha_hora' => Carbon::now(),
            ]);

       
    
        return redirect()->route('llamados_atencion.index')->with('success', 'Llamado de atención registrado correctamente.');
    }
    

    public function edit($id) {
        $llamado = LlamadoAtencion::findOrFail($id);
        return view('llamados_atencion.edit', compact('llamado'));
    }

    public function update(Request $request, $id) {
        $llamado = LlamadoAtencion::findOrFail($id);
    
        $request->validate([
            'codigo' => 'required|unique:llamados_atencion,codigo,' . $id, // Evita duplicados al actualizar
            'documento' => 'required',
            'trabajador' => 'required',
            'clase_falta' => 'required',
            'labor' => 'required',
            'fecha_notificacion' => 'required|date',
            'fecha_falta' => 'required|date',
            'asunto' => 'required',
            'descripcion_falta' => 'required',
            'documento_notificacion' => 'required',
            'nombre_notificacion' => 'required',
            'firma_notificacion' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validar imagen
            'cargo' => 'required',
        ]);
    
        $data = $request->all();
    
        if ($request->hasFile('firma_notificacion')) {
            // Eliminar la imagen anterior si existe
            if ($llamado->firma_notificacion) {
                Storage::disk('public')->delete($llamado->firma_notificacion);
            }
    
            // Guardar nueva imagen
            $file = $request->file('firma_notificacion');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('firmas', $filename, 'public');
            $data['firma_notificacion'] = $path;
        }
    
        $llamado->update($data);
        $ultimoRegistro = LlamadoAtencion::latest('updated_at')->first();

        MovimientoLlamado::create([
            'llamado_id' => $ultimoRegistro->id,
            'codigo_llamado' => $ultimoRegistro->codigo, 
            'usuario_id' => Auth::id(),
            'accion' => 'Edicion',
            'fecha_hora' => Carbon::now(),
        ]);
    
        return redirect()->route('llamados_atencion.index')->with('success', 'Llamado de atención actualizado correctamente.');
    }
    

   public function destroy($id)
    {
        $llamado = LlamadoAtencion::findOrFail($id);

        // Registrar el movimiento
        MovimientoLlamado::create([
            'llamado_id' => $llamado->id,
            'usuario_id' => Auth::id(),
            'codigo_llamado' => $llamado->codigo,
            'accion' => 'Desactivación',
            'fecha_hora' => Carbon::now()
        ]);

        // Cambiar estado en lugar de eliminar
        $llamado->estado = 0;
        $llamado->save();

        return redirect()->route('llamados_atencion.index')
                        ->with('success', 'Llamado de atención desactivado correctamente.');
    }

    public function buscar()
    {
        return view('llamados_atencion.buscar'); // Vista del formulario de búsqueda
    }

    public function buscarllamados(Request $request)
    {   
        $request->validate([
            'documento' => 'required|numeric'
        ]);

        $documento = $request->input('documento');
        $procesos = LlamadoAtencion::where('documento', $documento)->get();

        return view('llamados_atencion.listado', compact('procesos', 'documento'));
    }

    public function detalle($id)
    {
        $proceso = LlamadoAtencion::findOrFail($id);
        return view('llamados_atencion.detalle', compact('proceso'));
    }


     public function generarPDF($id)
        {
            $proceso = LlamadoAtencion::findOrFail($id);

            // 1. Generar PDF desde la vista con DomPDF (sin guardar en disco)
            $dompdf = Pdf::loadView('llamados_atencion.pdf_llamado', compact('proceso'))->setPaper('letter', 'portrait');
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


}
 
