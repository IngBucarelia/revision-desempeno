<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArpController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\DetalleEmpleadoController;
use App\Http\Controllers\BancoController;
use App\Http\Controllers\CajaCompController;
use App\Http\Controllers\CesantiasController;
use App\Http\Controllers\ClaseFaltaController;
use App\Http\Controllers\EpsController;
use App\Http\Controllers\PensionController;
use App\Http\Controllers\FaltaDisciplinariaController;
use App\Http\Controllers\RecordatorioController;
use App\Http\Controllers\MovimientoProcesoController;
use App\Http\Controllers\LlamadoAtencionController;
use App\Http\Controllers\MovimientollamadoController;
use App\Http\Controllers\EmpleadoImportController;
use App\Http\Controllers\InasistenciasController;
use App\Http\Controllers\ProcesoDisciplinarioImportController;
use App\Http\Controllers\LlamadoImportController;
use App\Http\Controllers\MovimientoNovedadesController;
use App\Http\Controllers\MoviminetoRevisionController;
use App\Http\Controllers\NovedadContratoController;
use App\Http\Controllers\OtrosiController;
use App\Http\Controllers\RevisionDesempenoController;
use App\Http\Controllers\ProrrogaController;
use App\Http\Controllers\SuspensionesController;
use App\Http\Controllers\TipoFaltaController;
use App\Models\Empleado;
use App\Models\FaltaDisciplinaria;
use App\Models\TipoFalta;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

// Página principal
Route::get('/', function () {
    return redirect()->route('login');
});

// ----------------------------**🔹 Rutas públicas (Login) **---------------------
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
    
    
});

//----------------------------** 🔹 Rutas protegidas (Solo para usuarios autenticados)**---------------------
Route::middleware(['auth'])->group(function () {
    
    
    // rutas de las vistas con permisos de sesion 
    Route::get('/dashboard', function () {return view('dashboard');});
    Route::get('/revisiondempeno', function () {return view('RevisionDesempeno');})->name('RevisionDesempeno');
    Route::get('/EmpleadosColaboradores', function () {return view('EmpleadosColaboradores');})->name('EmpleadosColaboradores');
    Route::get('/FaltasDisciplinarias', function () {return view('FaltasDisciplinarias');})->name('FaltasDisciplinarias');
    



    // rutas para manejo de usuarios por medio de la aplicacion
    Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios.index');

    Route::get('/usuarios/{id}', [UserController::class, 'show'])->name('usuarios.show');
    Route::get('/usuarios/{id}/edit', [UserController::class, 'edit'])->name('usuarios.edit');
    Route::put('/usuarios/{id}', [UserController::class, 'update'])->name('usuarios.update');
    Route::delete('/usuarios/{id}', [UserController::class, 'destroy'])->name('usuarios.destroy');



    // rutas usuario que manejan autenticacion ofrecida por laravel 
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    });

    Route::middleware(['role:user'])->group(function () {
        Route::get('/user', [UserController::class, 'index'])->name('user.index');
    });

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    Route::get('/dashboard', function () { return view('dashboard'); })->name('dashboard');

    Route::get('/profile/edit', function () {
        return view('profile.edit');
    })->name('profile.edit');
    

    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->middleware('auth')->name('verification.notice');
    
    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect('/dashboard');
    })->middleware(['auth', 'signed'])->name('verification.verify');
    
    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    })->middleware(['auth', 'throttle:6,1'])->name('verification.send');
    
    Route::middleware(['auth'])->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    });
//rutas register 
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
// ruta para el llamado de empleado desde la creacion del llamado de atención     
    Route::get('/buscar-empleado/{documento}', [EmpleadoController::class, 'buscarPorDocumento']);

    Route::get('/llamados/importar', [LlamadoImportController::class, 'showForm'])->name('llamados.importar.form');
    Route::post('/llamados/importar', [LlamadoImportController::class, 'import'])->name('llamados.importar');

    Route::get('/procesos/importar', [ProcesoDisciplinarioImportController::class, 'showForm'])->name('procesos.importar.form');
    Route::post('/procesos/importar', [ProcesoDisciplinarioImportController::class, 'import'])->name('procesos.importar');

    Route::get('/empleados/importar', [EmpleadoImportController::class, 'showForm'])->name('empleados.importar.form');
    Route::post('/empleados/importar', [EmpleadoImportController::class, 'import'])->name('empleados.importar');

    //Route::resource('empleados', EmpleadoController::class);

    // Ruta para mostrar el formulario de edición
    Route::get('/empleados/{id}/edit', [EmpleadoController::class, 'edit'])->name('empleados.edit');
    // Ruta para actualizar el empleado
    Route::put('/empleados/{id}', [EmpleadoController::class, 'update'])->name('empleados.update');
    // Ruta para eliminar el empleado
    Route::delete('/empleados/{id}', [EmpleadoController::class, 'destroy'])->name('empleados.destroy');



    Route::get('/empleados/create', [EmpleadoController::class, 'create'])->name('empleados.create');
    Route::post('/empleados/store', [EmpleadoController::class, 'store'])->name('empleados.store');
    Route::get('/empleados', [EmpleadoController::class, 'index'])->name('empleados.index');
    Route::get('/empleados', [EmpleadoController::class, 'index'])->name('empleados.index');
    Route::get('/empleados/create', [EmpleadoController::class, 'create'])->name('empleados.create');
    Route::post('/empleados/store', [EmpleadoController::class, 'store'])->name('empleados.store');
    Route::get('/empleados/{id}/detalle', [EmpleadoController::class, 'verDetalle'])->name('empleados.detalle');
    Route::get('/empleados/{id}/detalle/crear', [EmpleadoController::class, 'crearDetalle'])->name('empleados.detalle.crear');
    Route::post('/empleados/{id}/detalle/guardar', [EmpleadoController::class, 'guardarDetalle'])->name('empleados.detalle.guardar');
    Route::get('/empleados/{id}/detalle/editar', [DetalleEmpleadoController::class, 'editarDetalle'])->name('empleados.detalle.editar');
    Route::put('/empleados/{id}/detalle/actualizar', [DetalleEmpleadoController::class, 'actualizarDetalle'])->name('empleados.detalle.actualizar');

    // mostrar informacion individual de empleado 

    Route::get('/mi-perfil', [EmpleadoController::class, 'miPerfil'])->name('empleado.perfil')->middleware('auth');
    Route::get('/empleados/detalle/{id}', [EmpleadoController::class, 'detalleEmpleado'])->name('empleados.detalle');
    Route::get('/empleados/por-rol', [EmpleadoController::class, 'empleadosPorRol'])->name('empleados.porRol');



// Ruta para mostrar los bancos  y las entidades 

    Route::resource('bancos', BancoController::class);
    Route::resource('pension', PensionController::class);
    Route::resource('cesantia', CesantiasController::class);
    Route::resource('arp', ArpController::class);
    Route::resource('cajacomp', CajaCompController::class);
    Route::resource('eps', EpsController::class)->parameters(['eps' => 'eps']);

// rutas para las faltas disciplinarias 

    Route::resource('faltas_disciplinarias', FaltaDisciplinariaController::class);
    Route::resource('recordatorios', RecordatorioController::class);
    // routes/web.php

    // RUTA PARA MOSTRAR EL FORMULARIO (PETICIÓN GET)
    // Esta es la ruta que debes usar en los enlaces o botones para abrir la página del formulario.
    Route::get('/gestionar/{faltas_disciplinaria}', [FaltaDisciplinariaController::class, 'gestionarFase1'])->name('faltas_disciplinarias.gestionar');

    // RUTA PARA PROCESAR EL FORMULARIO (PETICIÓN PUT)
    // Esta es la ruta que debe ir en la acción de tu formulario.
    Route::put('/gestionarfase12/{faltas_disciplinaria}', [FaltaDisciplinariaController::class, 'fase1'])->name('faltas_disciplinarias.fase1');
    Route::get('/gestionar_fase1/{faltas_disciplinaria}', [FaltaDisciplinariaController::class, 'fase1']);
    
    Route::put('/gestionarfase2/{faltas_disciplinaria}', [FaltaDisciplinariaController::class, 'Updatefase2'])->name('faltas_disciplinarias.Updatefase2');

    Route::put('{faltas_disciplinaria}/updatefin', [FaltaDisciplinariaController::class, 'updateFin'])
    ->name('faltas_disciplinarias.updateFin'); 

    Route::put('{faltas_disciplinaria}/apelar', [FaltaDisciplinariaController::class, 'apelar'])
    ->name('faltas_disciplinarias.apelar'); 

    Route::put('{faltas_disciplinaria}/respuestaapelar', [FaltaDisciplinariaController::class, 'respuestaapelar'])
    ->name('faltas_disciplinarias.respuestaapelar'); 

    Route::get('/buscarprocesos', [FaltaDisciplinariaController::class, 'buscar'])->name('faltas_disciplinarias.buscar'); // Formulario de búsqueda
    Route::get('/procesos/buscar', [FaltaDisciplinariaController::class, 'buscarproceso'])->name('procesos.buscarfalta'); // Listado de resultados
    Route::get('/procesos/{id}', [FaltaDisciplinariaController::class, 'detalle'])->name('faltas_disciplinarias.detalle'); // Ver proceso específico
    Route::get('/procesos/fase2/{id}', [FaltaDisciplinariaController::class, 'Fase2'])->name('faltas_disciplinarias.fase2');
    Route::get('/procesos/fase0/{id}', [FaltaDisciplinariaController::class, 'Fase0'])->name('faltas_disciplinarias.fase0');
    Route::get('/procesos/tomardesicion/{id}', [FaltaDisciplinariaController::class, 'Tomardesicion'])->name('faltas_disciplinarias.Tomardesicion'); // Ver proceso específico
    Route::get('/proceso/{id}/imprimir', [FaltaDisciplinariaController::class, 'generarPDF'])->name('procesos.imprimir');
    
    Route::get('/procesos/decicion1/{id}', [FaltaDisciplinariaController::class, 'Desicionuno'])->name('faltas_disciplinarias.decision1'); // Ver proceso específico
    Route::get('/procesos/enapelacion/{id}', [FaltaDisciplinariaController::class, 'enapelacion'])->name('faltas_disciplinarias.enapelacion'); // Ver proceso específico
    Route::get('/procesos/desicionfinal/{id}', [FaltaDisciplinariaController::class, 'desicionfinal'])->name('faltas_disciplinarias.desicionfinal'); // Ver proceso específico

    
    // Ruta sin parámetro
    Route::get('/faltas/descargos', [FaltaDisciplinariaController::class, 'descargos'])->name('faltas_disciplinarias.descargos');
    Route::get('/faltas/pordesicion', [FaltaDisciplinariaController::class, 'pordesicion'])->name('faltas_disciplinarias.pordesicion');
    Route::get('/faltas/gestionados', [FaltaDisciplinariaController::class, 'yadecidido'])->name('faltas_disciplinarias.gestionados');
    Route::get('/faltas/primeraDesicion', [FaltaDisciplinariaController::class, 'primeraDesicion'])->name('faltas_disciplinarias.primeraDesicion');
    Route::get('/faltas/enDescargos', [FaltaDisciplinariaController::class, 'enDescargos'])->name('faltas_disciplinarias.enDescargos');
    Route::get('/faltas/DescargosPresentados', [FaltaDisciplinariaController::class, 'descargosPresentados'])->name('faltas_disciplinarias.descargosPresentados');

    Route::get('/faltas/apelacion', [FaltaDisciplinariaController::class, 'apelacion'])->name('faltas_disciplinarias.apelacion');

    // movimiento de procesos 

    Route::get('movimiento_faltas', [MovimientoProcesoController::class, 'index'])->name('faltas_disciplinarias.movimiento_faltas');
    // url envio notificaciones 
        // routes/web.php
    Route::get('/buscar-email/{documento}', function ($documento) {
        $empleado = \App\Models\Empleado::where('codigo', $documento)->first();

        return response()->json([
            'email' => $empleado?->correo
        ]);
    });




    Route::get('/buscar-info-empleado/{documento}', function ($documento) {
        $empleado = Empleado::where('codigo', $documento)->first();
        $falta = FaltaDisciplinaria::where('numero_documento_trabajador', $documento)
                ->whereIn('estado', [2, 4])
                ->latest() 
                ->first(); // Asegúrate que esto esté correcto

        return response()->json([
            'success' => $empleado !== null,
            'email' => $empleado?->correo,
            'nombre' => $empleado?->nombre,
            'falta' => $falta ? [
                'codigo' => $falta->codigo,
                'fecha_falta' => $falta->fecha_falta,
                'descripcion' => $falta->descripcion_falta,
                'clase_falta' => $falta->clase_falta,
                'tipo_falta' => $falta->tipo_falta,
                'labor' => $falta->labor,
            ] : null
        ]);
    });


    Route::get('/send-email', [FaltaDisciplinariaController::class, 'showForm'])->name('email.form');
    Route::post('/send-email', [FaltaDisciplinariaController::class, 'sendEmail'])->name('email.send');
    Route::get('/Notification', [FaltaDisciplinariaController::class, 'showForm'])->name('whatsapp.form');
    Route::post('/send-Notification', [FaltaDisciplinariaController::class, 'sendMessage'])->name('whatsapp.send');
//Ruta para los llamados de atención y recordatorios 

    Route::resource('llamados_atencion', LlamadoAtencionController::class);
    Route::get('/llamados/buscar', [LlamadoAtencionController::class, 'buscar'])->name('llamados_atencion.buscar'); // Listado de resultados
    Route::get('/llamados/buscarllamados', [LlamadoAtencionController::class, 'buscarllamados'])->name('llamados_atencion.buscarllamados'); // Listado de resultados
    Route::get('/llamados/{id}', [LlamadoAtencionController::class, 'detalle'])->name('llamados_atencion.detalle'); // Ver proceso específico
    Route::post('/llamados_atencion', [LlamadoAtencionController::class, 'store'])->name('llamados_atencion.store');
    Route::get('/llamados/{id}/imprimir', [LlamadoAtencionController::class, 'generarPDF'])->name('llamado.imprimir');
    Route::get('movimiento_llamados', [MovimientoLlamadoController::class, 'index'])->name('llamados_atencion.movimiento_llamados');
    Route::get('/buscar-llamados/{cedula}', [App\Http\Controllers\RevisionDesempenoController::class, 'buscarLlamados']);
    Route::get('/llamados-trabajador/{cedula}', [App\Http\Controllers\RevisionDesempenoController::class, 'verLlamados'])->name('llamados.trabajador.detalle');



// rutas para evaluacion de seguimierno 

    // Mostrar lista de revisiones
    Route::get('/revision_desempeno', [RevisionDesempenoController::class, 'index'])->name('revision_desempeno.index');
    // Mostrar formulario de creación
    Route::get('/revision_desempeno/create', [RevisionDesempenoController::class, 'create'])->name('revision_desempeno.create');
    // Guardar una nueva revisión
    Route::post('/revision_desempeno', [RevisionDesempenoController::class, 'store'])->name('revision_desempeno.store');
    // Mostrar una sola revisión (opcional)
    Route::get('/revision_desempeno/{id}', [RevisionDesempenoController::class, 'show'])->name('revision_desempeno.show');
    // Mostrar formulario de edición
    Route::get('/revision_desempeno/{id}/edit', [RevisionDesempenoController::class, 'edit'])->name('revision_desempeno.edit');
    // Actualizar una revisión
    Route::put('/revision_desempeno/{id}', [RevisionDesempenoController::class, 'update'])->name('revision_desempeno.update');
    // Eliminar una revisión
    Route::delete('/revision_desempeno/{id}', [RevisionDesempenoController::class, 'destroy'])->name('revision_desempeno.destroy');
    Route::get('revision_desempeno/create', [RevisionDesempenoController::class, 'create'])->name('revision_desempeno.create');
    Route::post('revision_desempeno', [RevisionDesempenoController::class, 'store'])->name('revision_desempeno.store');

    Route::get('revision_desempeno/gh/{id}/edit', [RevisionDesempenoController::class, 'editGH'])->name('revision_desempeno.edit.gh');
    Route::put('revision_desempeno/gh/{id}', [RevisionDesempenoController::class, 'updateGH'])->name('revision_desempeno.update.gh');

    Route::get('revision_desempeno/sst/{id}/edit', [RevisionDesempenoController::class, 'editSST'])->name('revision_desempeno.edit.sst');
    Route::put('revision_desempeno/sst/{id}', [RevisionDesempenoController::class, 'updateSST'])->name('revision_desempeno.update.sst');

    Route::get('revision_desempeno/jefe/{id}/edit', [RevisionDesempenoController::class, 'editJefe'])->name('revision_desempeno.edit.jefe');
    Route::put('revision_desempeno/jefe/{id}', [RevisionDesempenoController::class, 'updateJefe'])->name('revision_desempeno.update.jefe');

    Route::get('revision_desempeno/gerencia/{id}/edit', [RevisionDesempenoController::class, 'editGerencia'])->name('revision_desempeno.edit.gerencia');
    Route::put('revision_desempeno/gerencia/{id}', [RevisionDesempenoController::class, 'updateGerencia'])->name('revision_desempeno.update.gerencia');

    Route::get('revision_desempeno/detalle/{id}', [RevisionDesempenoController::class, 'detalleRevision'])->name('revision_desempeno.detalle');


    Route::get('/revision-desempeno/lista-gh', [RevisionDesempenoController::class, 'listaGh'])->name('revision_desempeno.lista.gh');
    Route::get('/revision-desempeno/lista-sst', [RevisionDesempenoController::class, 'listaSst'])->name('revision_desempeno.lista.sst');
    Route::get('/revision-desempeno/lista-jefe', [RevisionDesempenoController::class, 'listaJefe'])->name('revision_desempeno.lista.jefe');
    Route::get('/revision-desempeno/lista-gerencia', [RevisionDesempenoController::class, 'listaGerencia'])->name('revision_desempeno.lista.gerencia');
    Route::get('/revision-desempeno/Terminados', [RevisionDesempenoController::class, 'terminados'])->name('revision_desempeno.lista.terminados');
    Route::get('/revision-desempeno/TerminadosNo', [RevisionDesempenoController::class, 'terminadosNo'])->name('revision_desempeno.lista.terminadosNo');

    Route::get('/buscar-faltas/{cedula}', [RevisionDesempenoController::class, 'buscarFaltas']);
    Route::get('/faltas-trabajador/{cedula}', [RevisionDesempenoController::class, 'verFaltas'])->name('faltas.trabajador.detalle');
    Route::get('/suspenciones-trabajador/{cedula}', [RevisionDesempenoController::class, 'verSuspenciones'])->name('suspenciones.trabajador.detalle');
    Route::get('/inasistencias-trabajador/{cedula}', [RevisionDesempenoController::class, 'verInasistencias'])->name('inasistencias.trabajador.detalle');
    Route::get('/faltas-trabajador-sancion/{cedula}', [RevisionDesempenoController::class, 'verSanciones'])->name('faltas.trabajador.sancion');

    // routes/prorrogas 

    Route::resource('prorrogas', ProrrogaController::class);
    Route::get('/buscar-prorrogas/{cedula}', [App\Http\Controllers\ProrrogaController::class, 'buscarPorCedula']);
    Route::get('/prorrogas/detalle/{cedula}', [App\Http\Controllers\ProrrogaController::class, 'detalle']);
    Route::get('/revision/inasistencias/{cedula}', [RevisionDesempenoController::class, 'buscarInasistencias']);
    Route::get('/inasistencias/buscar/{cedula}', [InasistenciasController::class, 'vistaBuscarInasistencias'])->name('inasistencias.buscarVista');

    Route::get('/revision/suspenciones/{cedula}', [RevisionDesempenoController::class, 'buscarSuspenciones']);

    Route::get('/revision/imprimir/{id}', [RevisionDesempenoController::class, 'generarPDF'])->name('revision.imprimir');

    Route::get('/revision-desempeno/{id}/otrosi', [RevisionDesempenoController::class, 'generarOtrosi'])->name('revision.otrosi');

    Route::get('/revision/sansiones/{cedula}', [RevisionDesempenoController::class, 'contarSanciones'])->where('cedula', '[0-9]+'); // Asegura que la cédula sea numérica
    Route::get('movimiento_revisiones', [MoviminetoRevisionController::class, 'index'])->name('revision_desempeno.movimiento_revision');

    
    // router/inasistencias 

    Route::resource('inasistencias', InasistenciasController::class);
    Route::get('/buscar-inasistencias/{cedula}', [App\Http\Controllers\InasistenciasController::class, 'buscarPorCedula']);
    Route::get('/inasistencias/detalle/{cedula}', [App\Http\Controllers\InasistenciasController::class, 'detalle']);
    Route::get('/buscar-faltas-disciplinarias/inasistencias/{cedula}', [InasistenciasController::class, 'buscarFaltasDisciplinarias']);

    // router/suspensiones 

    Route::resource('suspensiones', SuspensionesController::class);
    Route::get('/buscar-suspensiones/{cedula}', [App\Http\Controllers\SuspensionesController::class, 'buscarPorCedula']);
    Route::get('/suspensiones/detalle/{cedula}', [App\Http\Controllers\SuspensionesController::class, 'detalle']);
    Route::get('/buscar-faltas-disciplinarias/inasistencias/{cedula}', [SuspensionesController::class, 'buscarFaltasDisciplinarias']);
        Route::get('/buscar-faltas-disciplinarias/suspenciones/{cedula}', [SuspensionesController::class, 'buscarFaltasDisciplinariasSuspenciones']);

    Route::get('/suspensiones/buscar', [SuspensionesController::class, 'buscar'])->name('suspensiones.buscar');


    // rutas de maestros 

    Route::resource('clases_faltas', ClaseFaltaController::class);
    Route::resource('tipo_faltas', TipoFaltaController::class);

    // rutas de otros si 

    Route::prefix('otrosis')->name('otrosis.')->group(function () {
    Route::get('/', [OtrosiController::class, 'index'])->name('index');
    Route::get('/create/{empleado}', [OtrosiController::class, 'create'])->name('create');
    Route::post('/store', [OtrosiController::class, 'store'])->name('store');
    Route::get('/{id}', [OtrosiController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [OtrosiController::class, 'edit'])->name('edit');
    Route::put('/{id}', [OtrosiController::class, 'update'])->name('update');    
});
    Route::get('/otrosis/verificar/{cedula}', [OtrosiController::class, 'verificar'])->name('otrosis.verificar');
    Route::get('/otrosis/{id}/imprimir', [OtrosiController::class, 'generarPDF'])->name('otrosis.imprimir');

    // novedades contrato 
    Route::prefix('novedades')->name('novedades_contrato.')->group(function () {
        Route::get('/', [NovedadContratoController::class, 'index'])->name('index');
        Route::get('/create', [NovedadContratoController::class, 'create'])->name('create');
        Route::post('/', [NovedadContratoController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [NovedadContratoController::class, 'edit'])->name('edit');
        Route::put('/{id}', [NovedadContratoController::class, 'update'])->name('update');
        Route::delete('/{id}', [NovedadContratoController::class, 'destroy'])->name('destroy');
        Route::get('/{id}/imprimir', [NovedadContratoController::class, 'imprimir'])->name('imprimir');
        Route::get('/{id}/detalle', [NovedadContratoController::class, 'verDetalle'])->name('verDetalle');

    });
    Route::get('/novedades/verificar-cedula', [NovedadContratoController::class, 'verificarCedula'])->name('novedades.verificarCedula');
    Route::post('/novedades/buscar-otros-si', [NovedadContratoController::class, 'buscarOtrosSi'])->name('novedades.buscarOtrosSi');
    Route::get('movimiento_novedades', [MovimientoNovedadesController::class, 'index'])->name('novedades_contrato.movimiento_novedades');
    Route::get('/movimientos-otrosi', [App\Http\Controllers\OtrosiController::class, 'verMovimientos'])->name('otrosi.movimientos');
        
    
    //nuevas funcionalidades 
        Route::get('/test-email', function() {
            try {
                Mail::raw('Texto de prueba SMTP', function($message) {
                    $message->to('ingdesarrollo@bucarelia.com.co')
                            ->subject('Prueba Final SMTP');
                });
                
                Log::info("Prueba de correo enviada");
                return response()->json([
                    'status' => 'success',
                    'message' => 'Correo enviado, verifica logs'
                ]);
                
            } catch (\Exception $e) {
                Log::error("Error en prueba SMTP: " . $e->getMessage());
                return response()->json([
                    'status' => 'error',
                    'message' => $e->getMessage()
                ], 500);
            }
        });
            
        Route::get('/faltas-disciplinarias/{id}/formulario-descargos', [FaltaDisciplinariaController::class, 'mostrarFormularioDescargos'])
            ->name('faltas_disciplinarias.formulario_descargos');

        });

        Route::post('/faltas-disciplinarias/{id}/guardar-descargos', [FaltaDisciplinariaController::class, 'guardarDescargos'])
            ->name('faltas_disciplinarias.guardar_descargos');


        Route::get('/faltas-disciplinarias/{id}/descargos-pdf', [FaltaDisciplinariaController::class, 'generarPdfDescargos'])
        ->name('faltas_disciplinarias.descargos_pdf');

        // En tu archivo routes/web.php, agrega esta nueva línea
        Route::get('/aviso/{id}', [FaltaDisciplinariaController::class, 'showAviso'])->name('faltas_disciplinarias.aviso');

        Route::get('/faltas-disciplinarias/{id}/ver-descargos', [FaltaDisciplinariaController::class, 'verDescargos'])->name('faltas_disciplinarias.ver_descargos');
