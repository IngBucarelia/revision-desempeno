<?php

namespace App\Http\Controllers;
use App\Models\RevisionDesempeno;
use App\Models\FaltaDisciplinaria;
use App\Models\LlamadoAtencion;

use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Models\MovimientoLlamado;
use App\Models\MovimientoRevision;
use App\Models\Suspension;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;
use setasign\Fpdi\Fpdi;
use Carbon\Carbon;




class RevisionDesempenoController extends Controller
{
    
    
   public function index(Request $request)
    {
        $query = $request->input('search');

        $registros = \App\Models\RevisionDesempeno::with('elaborado') // 👈 Esto carga la relación
            ->when($query, function ($q) use ($query) {
                $q->where('cedula', 'LIKE', "%$query%")
                ->orWhere('nombre_trabajador', 'LIKE', "%$query%")
                ->orWhere('fecha_solicitud', 'LIKE', "%$query%")
                ->orWhere('estado', 'LIKE', "%$query%");
            })
            ->latest('fecha_solicitud')
            ->paginate(7);

        if ($request->ajax()) {
            return view('revision_desempeno.index', compact('registros'))->render();
        }

        return view('revision_desempeno.index', compact('registros'));
    }



    public function create()
    {
        $empleados = Empleado::all();
        $empleadosGestionHumana = Empleado::where('rol', 'gh')->get();
        return view('revision_desempeno.create', [
            'empleados' => $empleados,
            'empleadosGestionHumana' => $empleadosGestionHumana
        ]);
    }

    public function store(Request $request)
    {
        $revision = RevisionDesempeno::create($request->all());
        $ultimoRegistro = RevisionDesempeno::latest('id')->first();

        MovimientoRevision::create([
            'llamado_id' => $ultimoRegistro->id,
            'codigo_llamado' => $ultimoRegistro->id, 
            'usuario_id' => Auth::id(),
            'accion' => 'Creación',
            'fecha_hora' => Carbon::now(),
        ]);
        //return redirect()->route('revision_desempeno.edit.gh', $revision->id);
        return redirect()->route('revision_desempeno.lista.gh');

    }

    public function update(Request $request, $id)
    {
        // Buscar el registro
        $registro = RevisionDesempeno::findOrFail($id);

        // Validación básica (puedes ajustarla si necesitas más campos obligatorios)
        $request->validate([
            'fecha_solicitud' => 'nullable|date',
            'cedula' => 'required',
            'nombre_trabajador' => 'required',
            'cargo' => 'nullable|string',
            'fecha_ingreso' => 'nullable|date',
            // Puedes agregar más reglas de validación aquí
        ]);

        // Actualizar con todos los campos del request
        $registro->update($request->all());
        $ultimoRegistro = RevisionDesempeno::latest('id')->first();

        MovimientoRevision::create([
            'llamado_id' => $ultimoRegistro->id,
            'codigo_llamado' => $ultimoRegistro->id, 
            'usuario_id' => Auth::id(),
            'accion' => 'edicion primera',
            'fecha_hora' => Carbon::now(),
        ]);

        return redirect()->route('revision_desempeno.index')
            ->with('success', 'Registro de revisión de desempeño actualizado correctamente.');
    }


    public function destroy($id)
    {
        $registro = RevisionDesempeno::findOrFail($id);

        // Opciónal: si llevas trazabilidad en una tabla tipo MovimientoRevisionDesempeno
        // Puedes registrar el cambio de estado
        

        // Solo actualiza el estado
        $registro->status = 0;
        $registro->save();
        $ultimoRegistro = RevisionDesempeno::latest('id')->first();

        MovimientoRevision::create([
            'llamado_id' => $ultimoRegistro->id,
            'codigo_llamado' => $ultimoRegistro->id, 
            'usuario_id' => Auth::id(),
            'accion' => 'Eliminacion',
            'fecha_hora' => Carbon::now(),
        ]);

        return redirect()->route('revision_desempeno.index')
                        ->with('success', 'Registro eliminado correctamente.');
    }


    // *****************************   listados de revision por estados *******************************************

    public function listaGh(Request $request)
        {
            $user = Auth::user();
            $query = RevisionDesempeno::where('estado', 'gh');

            if ($user->role_id !== 1) {
                $query->where('asignado_gh', $user->id);
            }

            if ($request->filled('search')) {
                $buscar = $request->input('search');
                $query->where(function ($q) use ($buscar) {
                    $q->where('id', 'like', "%$buscar%")
                    ->orWhere('cedula', 'like', "%$buscar%")
                    ->orWhere('fecha_solicitud', 'like', "%$buscar%")
                    ->orWhere('nombre_trabajador', 'like', "%$buscar%");
                });
            }

            $revisiones = $query->latest('fecha_solicitud')->paginate(7);

            if ($request->ajax()) {
                return view('revision_desempeno.panel_gh', compact('revisiones'))->render();
            }

            return view('revision_desempeno.panel_gh', compact('revisiones'));
        }


    public function listaSst(Request $request)
        {
        $user = Auth::user();

            $query = RevisionDesempeno::where('estado', 'sst');

            // Si NO es administrador, filtra por el usuario asignado
            if ($user->role_id !== 1) {
                $query->where('asignado_sst', $user->id);
            }

            // Filtros si deseas
             if ($request->filled('search')) {
                $buscar = $request->input('search');
                $query->where(function ($q) use ($buscar) {
                    $q->where('id', 'like', "%$buscar%")
                    ->orWhere('cedula', 'like', "%$buscar%")
                    ->orWhere('fecha_solicitud', 'like', "%$buscar%")
                    ->orWhere('nombre_trabajador', 'like', "%$buscar%");
                });
            }
             $revisiones = $query->latest('fecha_solicitud')->paginate(7);

            if ($request->ajax()) {
                return view('revision_desempeno.panel_sst', compact('revisiones'))->render();
            }

            return view('revision_desempeno.panel_sst', compact('revisiones'));
        }



    public function listaJefe(Request $request)
        {
            $user = Auth::user();

            $query = RevisionDesempeno::where('estado', 'jefe');

            // Si NO es administrador, filtra por el usuario asignado
            if ($user->role_id !== 1) {
                $query->where('jefe', $user->id);
            }
             if ($request->filled('search')) {
                $buscar = $request->input('search');
                $query->where(function ($q) use ($buscar) {
                    $q->where('id', 'like', "%$buscar%")
                    ->orWhere('cedula', 'like', "%$buscar%")
                    ->orWhere('fecha_solicitud', 'like', "%$buscar%")
                    ->orWhere('nombre_trabajador', 'like', "%$buscar%");
                });
            }
             $revisiones = $query->latest('fecha_solicitud')->paginate(7);

            if ($request->ajax()) {
                return view('revision_desempeno.panel_jefe', compact('revisiones'))->render();
            }

            return view('revision_desempeno.panel_jefe', compact('revisiones'));
        }


    public function listaGerencia(Request $request)
    {

        $user = Auth::user();

        $query = RevisionDesempeno::where('estado', 'gerencia');

        // Si NO es administrador, filtra por el usuario asignado
        if ($user->role_id !== 1) {
            $query->where('asignado_gerencia', $user->id);
        }

        // Filtros si deseas
        if ($request->filled('search')) {
                $buscar = $request->input('search');
                $query->where(function ($q) use ($buscar) {
                    $q->where('id', 'like', "%$buscar%")
                    ->orWhere('cedula', 'like', "%$buscar%")
                    ->orWhere('fecha_solicitud', 'like', "%$buscar%")
                    ->orWhere('nombre_trabajador', 'like', "%$buscar%");
                });
            }
             $revisiones = $query->latest('fecha_solicitud')->paginate(7);

            if ($request->ajax()) {
                return view('revision_desempeno.panel_gerencia', compact('revisiones'))->render();
            }

            return view('revision_desempeno.panel_gerencia', compact('revisiones'));
        }



    public function terminados(Request $request)
    {
        $userId = Auth::id();

        $query = RevisionDesempeno::where('estado', 'terminado')
         ->where('gerencia_cumple', 'si');

          

        // Filtros si deseas
         if ($request->filled('search')) {
                $buscar = $request->input('search');
                $query->where(function ($q) use ($buscar) {
                    $q->where('id', 'like', "%$buscar%")
                    ->orWhere('cedula', 'like', "%$buscar%")
                    ->orWhere('fecha_solicitud', 'like', "%$buscar%")
                    ->orWhere('nombre_trabajador', 'like', "%$buscar%");
                });
            }
             $revisiones = $query->latest('fecha_solicitud')->paginate(7);

            if ($request->ajax()) {
                return view('revision_desempeno.panel_terminado', compact('revisiones'))->render();
            }

            return view('revision_desempeno.panel_terminado', compact('revisiones'));
        }

    public function terminadosNo(Request $request)
    {
        $userId = Auth::id();

        $query = RevisionDesempeno::where('estado', 'terminado')
         ->where('gerencia_cumple', 'no');

          

       // Filtros si deseas
         if ($request->filled('search')) {
                $buscar = $request->input('search');
                $query->where(function ($q) use ($buscar) {
                    $q->where('id', 'like', "%$buscar%")
                    ->orWhere('cedula', 'like', "%$buscar%")
                    ->orWhere('fecha_solicitud', 'like', "%$buscar%")
                    ->orWhere('nombre_trabajador', 'like', "%$buscar%");
                });
            }
             $revisiones = $query->latest('fecha_solicitud')->paginate(7);

            if ($request->ajax()) {
                return view('revision_desempeno.panel_terminado_no', compact('revisiones'))->render();
            }

            return view('revision_desempeno.panel_terminado_no', compact('revisiones'));
        }


// ***************************************** Zona de ediciones por estado *************************************
public function detalleRevision($id)
    {
        $registro = RevisionDesempeno::findOrFail($id);
        $empleadosGestionHumana = Empleado::where('rol', 'sst')->get();
        $jefe_inmediato = Empleado::where('rol', 'jefe_inmediato')->get();
        return view('revision_desempeno.detalle', compact('registro', 'empleadosGestionHumana', 'jefe_inmediato'));
    }    

public function editGH($id)
    {
        $revision = RevisionDesempeno::findOrFail($id);
        $empleadosGestionHumana = Empleado::where('rol', 'sst')->get();
        return view('revision_desempeno.edit_gh', compact('revision', 'empleadosGestionHumana'));
    }

   
    public function updateGH(Request $request, $id)
    {
        $revision = RevisionDesempeno::findOrFail($id);
        
        // Validación de todos los campos  
        $validatedData = $request->validate([
            'faltas_disciplinarias' => 'nullable|string|max:255',
            'llamados_atencion' => 'nullable|string|max:255',
            'sanciones' => 'nullable|string|max:255',
            'inasistencias' => 'nullable|string|max:255',
            'suspenciones' => 'nullable|string|max:255',
            'observaciones_gh' => 'nullable|string|max:1000',
            'gh_diligenciado_por' => 'required|string|max:255',
            'gh_firma' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gh_firma_actual' => 'nullable|string',
            'gh_fecha' => 'required|date',
            'asignado_sst' => 'required|integer|exists:empleados,id',
            'estado' => 'required|string|in:sst',
            'gh_cumple' => 'nullable|string|max:255',
        ], [
            'gh_firma.image' => 'El archivo de firma debe ser una imagen válida',
            'gh_firma.mimes' => 'La firma debe ser en formato JPEG, PNG o GIF',
            'gh_firma.max' => 'La imagen de firma no debe exceder 2MB',
            'gh_fecha.required' => 'La fecha es obligatoria',
            'gh_fecha.date' => 'La fecha debe tener un formato válido',
            'asignado_sst.required' => 'Debe asignar a un responsable de SST',
            'asignado_sst.exists' => 'El empleado seleccionado no existe'
        ]);
        
        try {
            // Manejo de la firma
            if ($request->hasFile('gh_firma')) {
                // Eliminar firma anterior si existe
                if ($revision->gh_firma && file_exists(public_path($revision->gh_firma))) {
                    unlink(public_path($revision->gh_firma));
                }
                
                // Guardar nueva firma directamente en public/storage/firmas
                $file = $request->file('gh_firma');
                $filename = time().'_'.$file->getClientOriginalName();
                $path = 'storage/firmas/'.$filename; // Ruta relativa
                
                // Crear directorio si no existe
                if (!file_exists(public_path('storage/firmas'))) {
                    mkdir(public_path('storage/firmas'), 0755, true);
                }
                
                $file->move(public_path('storage/firmas'), $filename);
                $validatedData['gh_firma'] = $path;
            } elseif ($request->has('gh_firma_actual')) {
                // Mantener firma existente
                $validatedData['gh_firma'] = $request->gh_firma_actual;
            } else {
                // Eliminar firma si no se proporcionó
                $validatedData['gh_firma'] = null;
            }
            
            // ... (resto de tu lógica de actualización)
            
            $revision->update($validatedData);
            $ultimoRegistro = RevisionDesempeno::latest('updated_at')->first();

            MovimientoRevision::create([
                'llamado_id' => $ultimoRegistro->id,
                'codigo_llamado' => $ultimoRegistro->id, 
                'usuario_id' => Auth::id(),
                'accion' => 'Edito GH',
                'fecha_hora' => Carbon::now(),
            ]);
            
            return redirect()->route('revision_desempeno.lista.gh', $revision->id)
                            ->with('success', 'Revisión actualizada correctamente');
                            
        } catch (\Exception $e) {
            Log::error('Error al actualizar revisión: '.$e->getMessage());
            return back()
                ->withInput()
                ->with('error', 'Error al actualizar la revisión: '.$e->getMessage());
        }
    }

    public function editSST($id)
    {
        $revision = RevisionDesempeno::findOrFail($id);
        $empleados = Empleado::where('rol', 'jefe')->get();
        return view('revision_desempeno.editSST', compact('revision', 'empleados'));
    }
    public function updateSST(Request $request, $id)
    {
        $revision = RevisionDesempeno::findOrFail($id);
    
        $validatedData = $request->validate([
            'cumplimiento_sgsst' => 'nullable|string',
            'habitos_comportamientos' => 'nullable|string',
            'sst_diligenciado_por' => 'required|string',
            'sst_firma' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'sst_firma_actual' => 'nullable|string',
            'sst_fecha' => 'required|date',
            'sst_cumple' => 'nullable|string',
            'jefe' => 'nullable|string',
            'estado' => 'required|string'
        ], [
            'sst_firma.image' => 'El archivo de firma debe ser una imagen válida',
            'sst_firma.mimes' => 'La firma debe ser en formato JPEG, PNG o GIF',
            'sst_firma.max' => 'La imagen de firma no debe exceder 2MB'
        ]);
    
        try {
            // Manejo de la firma SST (igual que en GH)
            if ($request->hasFile('sst_firma')) {
                // Eliminar firma anterior si existe
                if ($revision->sst_firma && file_exists(public_path($revision->sst_firma))) {
                    unlink(public_path($revision->sst_firma));
                }
                
                // Guardar nueva firma directamente en public/storage/firmas
                $file = $request->file('sst_firma');
                $filename = time().'_'.$file->getClientOriginalName();
                $path = 'storage/firmas/'.$filename; // Ruta relativa
                
                // Crear directorio si no existe
                if (!file_exists(public_path('storage/firmas'))) {
                    mkdir(public_path('storage/firmas'), 0755, true);
                }
                
                $file->move(public_path('storage/firmas'), $filename);
                $validatedData['sst_firma'] = $path;
            } elseif ($request->has('sst_firma_actual')) {
                // Mantener firma existente
                $validatedData['sst_firma'] = $request->sst_firma_actual;
            } else {
                // Eliminar firma si no se proporcionó
                $validatedData['sst_firma'] = null;
            }
    
            $revision->update($validatedData);
            $ultimoRegistro = RevisionDesempeno::latest('updated_at')->first();

            MovimientoRevision::create([
                'llamado_id' => $ultimoRegistro->id,
                'codigo_llamado' => $ultimoRegistro->id, 
                'usuario_id' => Auth::id(),
                'accion' => 'Edito SSt',
                'fecha_hora' => Carbon::now(),
            ]);
    
            return redirect()->route('revision_desempeno.lista.sst', $revision->id)
                            ->with('success', 'Sección SST actualizada correctamente');
    
        } catch (\Exception $e) {
            Log::error('Error al actualizar firma SST: '.$e->getMessage());
            return back()->with('error', 'Error al actualizar la firma: '.$e->getMessage())
                        ->withInput();
        }
    }

    
    public function editJefe($id)
    {
        $revision = RevisionDesempeno::findOrFail($id);
        $empleados = Empleado::where('rol', 'gerente')->get();
        $jefe_inmediato = Empleado::where('rol', 'jefe_inmediato')->get();
        return view('revision_desempeno.editjefe', compact('revision', 'empleados', 'jefe_inmediato'));
    }

    public function updateJefe(Request $request, $id)
    {
        $revision = RevisionDesempeno::findOrFail($id);

        // Validación de campos
        $validatedData = $request->validate([
            'labor_actual' => 'nullable|string',
            'labores_desempenadas' => 'nullable|string',
            'calidad_labor' => 'nullable|string',
            'cumplimiento' => 'nullable|string',
            'productividad' => 'nullable|string',
            'relaciones' => 'nullable|string',
            'otras' => 'nullable|string',
            'jefe_inmediato' => 'nullable|string',
            'jefe_diligenciado_por' => 'required|string',
            'jefe_firma' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'jefe_firma_actual' => 'nullable|string',
            'jefe_fecha' => 'required|date',
            'jefe_cumple' => 'nullable|string',
            'asignado_gerencia' => 'required|exists:empleados,id',
            'estado' => 'required|string',
            'revisado_por' => 'nullable|string'
        ], [
            'jefe_firma.image' => 'El archivo debe ser una imagen válida',
            'jefe_firma.mimes' => 'Formatos permitidos: JPEG, PNG, JPG, GIF',
            'jefe_firma.max' => 'La imagen no debe exceder 2MB',
            'asignado_gerencia.required' => 'Debe asignar a un responsable de Gerencia'
        ]);

        try {
            // Manejo de la firma SST (igual que en GH)
            if ($request->hasFile('jefe_firma')) {
                // Eliminar firma anterior si existe
                if ($revision->jefe_firma && file_exists(public_path($revision->jefe_firma))) {
                    unlink(public_path($revision->jefe_firma));
                }
                
                // Guardar nueva firma directamente en public/storage/firmas
                $file = $request->file('jefe_firma');
                $filename = time().'_'.$file->getClientOriginalName();
                $path = 'storage/firmas/'.$filename; // Ruta relativa
                
                // Crear directorio si no existe
                if (!file_exists(public_path('storage/firmas'))) {
                    mkdir(public_path('storage/firmas'), 0755, true);
                }
                
                $file->move(public_path('storage/firmas'), $filename);
                $validatedData['jefe_firma'] = $path;
            } elseif ($request->has('jefe_firma_actual')) {
                // Mantener firma existente
                $validatedData['jefe_firma'] = $request->jefe_firma_actual;
            } else {
                // Eliminar firma si no se proporcionó
                $validatedData['jefe_firma'] = null;
            }
            // Actualizar todos los datos
            $revision->update($validatedData);
            $ultimoRegistro = RevisionDesempeno::latest('updated_at')->first();

            MovimientoRevision::create([
                'llamado_id' => $ultimoRegistro->id,
                'codigo_llamado' => $ultimoRegistro->id, 
                'usuario_id' => Auth::id(),
                'accion' => 'Edito Jefe',
                'fecha_hora' => Carbon::now(),
            ]);

            return redirect()->route('revision_desempeno.lista.jefe', $revision->id)
                        ->with('success', 'Evaluación de Jefatura actualizada correctamente');

        } catch (\Exception $e) {
            Log::error('Error al actualizar evaluación de jefatura: '.$e->getMessage());
            return back()->with('error', 'Error al guardar: '.$e->getMessage())
                    ->withInput();
        }
    }

    public function editGerencia($id)
    {
        $revision = RevisionDesempeno::findOrFail($id);
        $empleados = Empleado::all();
        return view('revision_desempeno.editGerencia', compact('revision', 'empleados'));
    }

    public function detalle($id)
    {
        $registro = RevisionDesempeno::findOrFail($id);
        $empleados = Empleado::all();
        $registro->elaborado_nombre = optional(\App\Models\Empleado::find($registro->elaborado_por))->nombre;
        $registro->revisado_nombre = optional(\App\Models\Empleado::find($registro->revisado_por))->nombre;
        $registro->aprobado_nombre = optional(\App\Models\Empleado::find($registro->aprobado_por))->nombre;

        return view('revision_desempeno.detalle', compact('registro', 'empleados'));
    }

    public function updateGerencia(Request $request, $id)
    {
        $revision = RevisionDesempeno::findOrFail($id);
    
        // Validación de campos
        $validatedData = $request->validate([
            'fecha_gerencia' => 'required|date',
            'gerencia_cumple' => 'nullable|string',
            'observaciones_gerencia' => 'nullable|string',
            'autorizado_por' => 'required|string',
            'firma_autorizado' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'firma_autorizado_actual' => 'nullable|string',           
            'elaborado_por' => 'nullable|string',
            'revisado_por' => 'nullable|string',
            'aprobado_por' => 'nullable|string',
            'fecha_aprobacion' => 'nullable|date',
            'estado' => 'required|string',
        ], [
            'firma_autorizado.image' => 'El archivo debe ser una imagen válida',
            'firma_autorizado.mimes' => 'Formatos permitidos: JPEG, PNG, JPG, GIF',
            'firma_autorizado.max' => 'La imagen no debe exceder 2MB',
            'autorizado_por.required' => 'Debe diligenciar quién autoriza',
            'asignado_elavorado.required' => 'Debe asignar a un responsable',
        ]);
    
        try {
            // Manejo de la firma autorizada (igual que jefe_firma)
            if ($request->hasFile('firma_autorizado')) {
                if ($revision->firma_autorizado && file_exists(public_path($revision->firma_autorizado))) {
                    unlink(public_path($revision->firma_autorizado));
                }
    
                $file = $request->file('firma_autorizado');
                $filename = time().'_'.$file->getClientOriginalName();
                $path = 'storage/firmas/'.$filename;
    
                if (!file_exists(public_path('storage/firmas'))) {
                    mkdir(public_path('storage/firmas'), 0755, true);
                }
    
                $file->move(public_path('storage/firmas'), $filename);
                $validatedData['firma_autorizado'] = $path;
            } elseif ($request->has('firma_autorizado_actual')) {
                $validatedData['firma_autorizado'] = $request->firma_autorizado_actual;
            } else {
                $validatedData['firma_autorizado'] = null;
            }
    
            $revision->update($validatedData);
            $ultimoRegistro = RevisionDesempeno::latest('updated_at')->first();           

            MovimientoRevision::create([
                'llamado_id' => $ultimoRegistro->id,
                'codigo_llamado' => $ultimoRegistro->id, 
                'usuario_id' => Auth::id(),
                'accion' => 'Reviso Gerencia',
                'fecha_hora' => Carbon::now(),
            ]);
        
            return redirect()->route('revision_desempeno.lista.gerencia')
                    ->with('success', 'Revisión de desempeño finalizada correctamente.');
    
        } catch (\Exception $e) {
            Log::error('Error al actualizar evaluación de gerencia: '.$e->getMessage());
            return back()->with('error', 'Error al guardar: '.$e->getMessage())->withInput();
        }
    }
    

    public function edit($id)
    {
        $registro = RevisionDesempeno::findOrFail($id);
        $empleados = Empleado::all();
        return view('revision_desempeno.edit', compact('registro', 'empleados'));
    }

    public function buscarFaltas($cedula)
    {
        $faltas = FaltaDisciplinaria::where('numero_documento_trabajador', $cedula)->get();

        if ($faltas->count() > 0) {
            return response()->json([
                'status' => 'found',
                'total' => $faltas->count(),
                'detalle_url' => route('faltas.trabajador.detalle', ['cedula' => $cedula])
            ]);
        } else {
            return response()->json(['status' => 'not_found']);
        }
    }

    public function verFaltas($cedula)
    {
        $faltas = FaltaDisciplinaria::where('numero_documento_trabajador', $cedula)->get();

        return view('revision_desempeno.faltas_usuario', compact('faltas', 'cedula'));
    }

    public function verSanciones($cedula)
    {

         $faltas = DB::table('faltas_disciplinarias')
                    ->where('numero_documento_trabajador', $cedula)
                    ->where('sancion', '1')
                    ->get();

        return view('faltas_disciplinarias.detalle_sanciones', compact('faltas', 'cedula'));
    }

    public function verSuspenciones($cedula)
    {
        $faltas = Suspension::where('cedula', $cedula)->get();

        return view('revision_desempeno.suspenciones_usuario', compact('faltas', 'cedula'));
    }

    public function verInasistencias($cedula)
    {
        $faltas = Suspension::where('cedula', $cedula)->get();

        return view('revision_desempeno.inasistencias_usuario', compact('faltas', 'cedula'));
    }

    
    public function buscarLlamados($cedula)
    {
        $llamados = LlamadoAtencion::where('documento', $cedula)->get();

        if ($llamados->count() > 0) {
            return response()->json([
                'status' => 'found',
                'total' => $llamados->count(),
                'detalle_url' => route('llamados.trabajador.detalle', ['cedula' => $cedula])
            ]);
        } else {
            return response()->json(['status' => 'not_found']);
        }
    }

    public function verLlamados($cedula)
    {
        $llamados = LlamadoAtencion::where('documento', $cedula)->get();
        return view('revision_desempeno.detalle_llamados', compact('llamados', 'cedula'));
    }


    


    public function detalleInasistencias($cedula)
    {
        $inasistencias = FaltaDisciplinaria::whereRaw('TRIM(numero_documento_trabajador) = ?', [$cedula])
            ->whereRaw('LOWER(TRIM(clase_falta)) = ?', ['inasistencia'])
            ->get();

        return view('revision.inasistencias_detalle', compact('inasistencias', 'cedula'));
    }

    public function buscarInasistencias($cedula)
    {        $inasistencias = DB::table('suspensiones')
            ->where('cedula', $cedula)            
            ->count();

        if ($inasistencias > 0) {
            return response()->json([
                'status' => 'found',
                'total' => $inasistencias,
                'detalle_url' => route('inasistencias.trabajador.detalle', ['cedula' => $cedula])
            ]);
        } else {
            return response()->json(['status' => 'not_found']);
        }
    }

    public function buscarSuspenciones($cedula) 
    {
            $suspensiones = DB::table('suspensiones')
            ->where('cedula', $cedula)            
            ->count();

        if ($suspensiones > 0) {
            return response()->json([
                'status' => 'found',
                'total' => $suspensiones,
                'detalle_url' => route('suspenciones.trabajador.detalle', ['cedula' => $cedula])
            ]);
        } else {
            return response()->json(['status' => 'not_found']);
        }
    }

    public function contarSanciones($cedula)
        {
            try {
                // Validación básica
                if (!is_numeric($cedula)) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Cédula debe ser numérica'
                    ], 400);
                }

                $totalSanciones = DB::table('faltas_disciplinarias')
                    ->where('numero_documento_trabajador', $cedula)
                    ->where('sancion', '1')
                    ->count();

                return response()->json([
                    'status' => $totalSanciones > 0 ? 'found' : 'not_found',
                    'total' => $totalSanciones,
                    'detalle_url' => $totalSanciones > 0 
                        ? route('faltas.trabajador.sancion', ['cedula' => $cedula])
                        : null
                ]);

            } catch (\Exception $e) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Error en el servidor: ' . $e->getMessage()
                ], 500);
            }
        }

        public function generarPDF($id)
        {
            $registro = RevisionDesempeno::findOrFail($id);

            // 1. Generar PDF desde la vista con DomPDF (sin guardar en disco)
            $dompdf = Pdf::loadView('revision_desempeno.pdf_revision', compact('registro'))->setPaper('letter', 'portrait');
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
            if ($registro->pdf_evidencia && file_exists(public_path($registro->pdf_evidencia))) {
                $evidenciaPath = public_path($registro->pdf_evidencia);
                $eviPages = $finalPdf->setSourceFile($evidenciaPath);
                for ($i = 1; $i <= $eviPages; $i++) {
                    $tplIdx = $finalPdf->importPage($i);
                    $finalPdf->AddPage();
                    $finalPdf->useTemplate($tplIdx);
                }
            }

            // 4. Descargar directamente sin guardar en el servidor
            return response($finalPdf->Output('I', "Falta_{$registro->codigo}.pdf")) // 'I' = inline en navegador, 'D' = descarga
                ->header('Content-Type', 'application/pdf');
        }

        public function generarOtrosi($id)
        {
            $revision = RevisionDesempeno::findOrFail($id);
            $empleado = Empleado::where('codigo', $revision->codigo)->first();

            return view('revision_desempeno.otrosi', compact('revision', 'empleado'));
        }

}
