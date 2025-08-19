<x-app-layout>
    <x-appbar />


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

<link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css_dascboard.css') }}">
<style>
    /* Cambiar color de texto en pestañas activas */
.nav-pills .nav-link.active, 
.nav-pills .show > .nav-link {
    color: #fff !important; /* Texto blanco cuando está activo */
    background-color: #6c757d !important; /* Fondo gris cuando está activo */
}

/* Color de texto cuando NO está activo */
.nav-pills .nav-link {
    color: #212529 !important; /* Texto negro/gris oscuro */
}

/* Opcional: Cambiar color al pasar el mouse */
.nav-pills .nav-link:hover {
    color: #495057 !important;
}
.adaptable-container {
  width: 100%;
  max-width: 100%; /* Evita que se desborde */
  height: 1300px !important;
  display: block; /* o flex si usas flexbox */
  padding: 20px; /* opcional: para separar el contenido de los bordes */
  box-sizing: border-box; /* importante para que padding no afecte el tamaño total */
}
</style>
    <div class="contenedor-principal">
        <x-sidebar />

<div class="container adaptable-container" >
    <h2 class="text-center mb-4">Revisión de Desempeño - Sección Gerencia</h2>
    
    <div class="row">
        <!-- Pestañas verticales -->
        <div class="col-md-2">
            <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <button style="height: 80px; background-color:#218838" class="nav-link active mb-2 text-start" id="v-pills-general-tab" data-bs-toggle="pill" data-bs-target="#v-pills-general" type="button" role="tab" aria-controls="v-pills-general" aria-selected="true">
                    <i class="bi bi-person-lines-fill me-2"></i> Información General
                </button>
                <button style="height: 80px; background-color:#218838" class="nav-link mb-2 text-start" id="v-pills-gh-tab" data-bs-toggle="pill" data-bs-target="#v-pills-gh" type="button" role="tab" aria-controls="v-pills-gh" aria-selected="false">
                    <i class="bi bi-people-fill me-2"></i> Gestión Humana
                </button>
                <button style="height: 80px; background-color:#218838" class="nav-link mb-2 text-start" id="v-pills-sst-tab" data-bs-toggle="pill" data-bs-target="#v-pills-sst" type="button" role="tab" aria-controls="v-pills-sst" aria-selected="false">
                    <i class="bi bi-shield-check me-2"></i> Seguridad y Salud
                </button>
                <button style="height: 80px; background-color:#218838" class="nav-link mb-2 text-start" id="v-pills-jefe-tab" data-bs-toggle="pill" data-bs-target="#v-pills-jefe" type="button" role="tab" aria-controls="v-pills-jefe" aria-selected="false">
                    <i class="bi bi-person-badge me-2"></i> Evaluación Jefatura
                </button>
                <button style="height: 80px; background-color:#218838; " class="nav-link mb-2 text-start" id="v-pills-gerencia-tab" data-bs-toggle="pill" data-bs-target="#v-pills-gerencia" type="button" role="tab" aria-controls="v-pills-gerencia" aria-selected="false">
                    <i class="bi bi-building me-2"></i> Gerencia
                </button>
            </div>
        </div>

        <!-- Contenido de las pestañas -->
        <div class="col-md-9">
            <div class="tab-content" id="v-pills-tabContent">
                <!-- Pestaña de Información General -->
                <div class="tab-pane fade show active" id="v-pills-general" role="tabpanel" aria-labelledby="v-pills-general-tab">
                    <div class="card shadow-sm">
                        <div class="card-body p-0">
                            <table class="table table-bordered table-striped mb-0">
                                <tr>
                                    <td colspan="4" class="text-center bg-secondary text-white">Información Básica</td>
                                </tr>
                                <tr>
                                    <td width="25%"><strong>Fecha Solicitud</strong></td>
                                    <td width="25%">{{ $revision->fecha_solicitud }}</td>
                                    <td width="25%"><strong>Cédula</strong></td>
                                    <td width="25%">{{ $revision->cedula }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Nombre Trabajador</strong></td>
                                    <td>{{ $revision->nombre_trabajador }}</td>
                                    <td><strong>Cargo</strong></td>
                                    <td>{{ $revision->cargo }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Fecha Ingreso</strong></td>
                                    <td>{{ $revision->fecha_ingreso }}</td>
                                    <td><strong>Prórrogas</strong></td>
                                    <td>{{ $revision->prorrogas }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Fecha Vencimiento</strong></td>
                                    <td>{{ $revision->fecha_vencimiento }}</td>
                                    <td><strong>Estado Actual</strong></td>
                                    <td class="fw-bold">{{ ucfirst($revision->estado) }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                        <!-- Pestaña de Gestión Humana -->
                        <div class="tab-pane fade" id="v-pills-gh" role="tabpanel" aria-labelledby="v-pills-gh-tab">
                            <div class="card shadow-sm">
                                <div class="card-body p-0">
                                    <table class="table table-bordered table-striped mb-0">
                                        <tr>
                                            <td colspan="4" class="text-center bg-success text-white">Evaluación de Gestión Humana</td>
                                        </tr>
                                        <tr>
                                            <td width="25%"><strong>Faltas Disciplinarias</strong></td>
                                            <td width="25%">
                                                {{ $revision->faltas_disciplinarias ?? 'N/A' }}
                                                @if($revision->faltas_disciplinarias)
                                                <br><a href="{{ route('faltas.trabajador.detalle', ['cedula' => $revision->cedula]) }}" target="_blank" class="btn btn-info btn-sm ms-2">👁️ Ver</a>
                                                @endif
                                            </td>
                                            <td width="25%"><strong>Llamados de Atención</strong></td>
                                            <td width="25%">
                                                {{ $revision->llamados_atencion ?? 'N/A' }}
                                                @if($revision->llamados_atencion)
                                                <br><a href="{{ route('llamados.trabajador.detalle', ['cedula' => $revision->cedula]) }}" target="_blank" class="btn btn-info btn-sm ms-2">👁️ Ver</a>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Sanciones</strong></td>
                                            <td>
                                               
                                                <input style="border: none; background-color:transparent" type="text" name="sanciones" class="form-control" readonly>
                                                <a id="verSancionesBtn" href="#" target="_blank" class="btn btn-info btn-sm" style="display: none;">
                                                👁️ Ver 
                                                </a>
                                            </td>
                                            <td><strong>Inasistencias</strong></td>
                                            <td>
                                               
                                                    <input style="border: none; background-color:transparent" type="text" name="inasistencias" class="form-control" readonly>
                                                    <a id="verInasistenciasBtn" href="#" target="_blank" class="btn btn-info" style="display: none;">👁️ Ver</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Suspensiones</strong></td>
                                            <td>
                                                <input style="border: none; background-color:transparent" type="text" name="suspenciones" class="form-control" readonly>
                                                    <a id="verSuspencionesBtn" href="#" target="_blank" class="btn btn-info" style="display: none;">👁️ Ver</a>
                                            </td>
                                            <td><strong>Cumple Gestion Humana </strong></td>
                                            <td>{{ $revision->gh_cumple ?? 'Sin observaciones' }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="1"><strong>Observaciones GH</strong></td>
                                            <td colspan="3">{{ $revision->observaciones_gh ?? 'Sin observaciones' }}</td>
                                        
                                        </tr>
                                        <tr>
                                            <td><strong>Diligenciado por</strong></td>
                                            <td>{{ $revision->gh_diligenciado_por }}</td>
                                            <td colspan="2">
                                                @if($revision->gh_firma)
                                                    <div class="firma-container" style="margin: 15px 0;">
                                                        <p><strong>Firma Digital:</strong></p>
                                                        <img src="{{ asset($revision->gh_firma) }}" 
                                                            alt="Firma de {{ $revision->gh_diligenciado_por }}"
                                                            style="max-width: 200px; max-height: 100px; border: 1px solid #ddd; padding: 5px;"
                                                            onerror="this.onerror=null; this.src='{{ url($revision->gh_firma) }}'">
                                                        <p class="text-muted small">
                                                            Firmado por: {{ $revision->gh_diligenciado_por }}
                                                            el {{ \Carbon\Carbon::parse($revision->gh_fecha)->format('d/m/Y') }}
                                                        </p>
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                <!-- Pestaña de Seguridad y Salud -->
                <div class="tab-pane fade" id="v-pills-sst" role="tabpanel" aria-labelledby="v-pills-sst-tab">
                    <div class="card shadow-sm">
                        <div class="card-body p-0">
                            <table class="table table-bordered table-striped mb-0">
                                <tr>
                                    <td colspan="4" class="text-center bg-success text-white">Evaluación de SST</td>
                                </tr>
                                <tr>
                                    <td width="25%"><strong>Cumplimiento SG-SST</strong></td>
                                    <td colspan="3">{{ $revision->cumplimiento_sgsst ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Hábitos y Comportamientos</strong></td>
                                    <td colspan="3">{{ $revision->habitos_comportamientos ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Diligenciado por</strong></td>
                                    <td>{{ $revision->sst_diligenciado_por ?? 'N/A' }}</td>
                                    <td><strong>Firma SST</strong></td>
                                    <td>
                                        @if($revision->sst_firma)
                                            <img src="{{ asset($revision->sst_firma) }}" 
                                                 class="img-thumbnail"
                                                 style="max-width: 120px; max-height: 60px;">
                                        @else
                                            <span class="text-muted">Sin firma registrada</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Fecha</strong></td>
                                    <td>{{ $revision->sst_fecha ? \Carbon\Carbon::parse($revision->sst_fecha)->format('d/m/Y') : 'N/A' }}</td>
                                    <td><strong>¿Cumple con SST?</strong></td>
                                    <td>{{ $revision->sst_cumple ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Asignado a Jefe Inmediato</strong></td>
                                    <td colspan="3">
                                        @php
                                            $asignadojefe = $revision->asignadoSST ?? App\Models\Empleado::find($revision->jefe);
                                        @endphp
                                        
                                        @if($asignadojefe)
                                            <div class="d-flex align-items-center">
                                                <div class="me-3">
                                                    <i class="fas fa-user-shield"></i> {{ $asignadojefe->nombre }}
                                                    @if($asignadojefe->cargo)
                                                        <br>
                                                        <small class="text-muted">
                                                            <i class="fas fa-briefcase"></i> {{ $asignadojefe->cargo }}
                                                        </small>
                                                    @endif
                                                </div>
                                            </div>
                                        @else
                                            <span class="text-danger">
                                                <i class="fas fa-exclamation-triangle"></i> No asignado
                                                @if($revision->asignado_sst)
                                                    (ID {{ $revision->asignado_sst }} no encontrado)
                                                @endif
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Estado de Revisión</strong></td>
                                    <td colspan="3">
                                        Revisado Seguridad Salud en el Trabajo
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Pestaña de Jefatura -->
                <div class="tab-pane fade" id="v-pills-jefe" role="tabpanel" aria-labelledby="v-pills-jefe-tab">
                    <div class="card shadow-sm">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped mb-0 text-start align-middle" style="table-layout: fixed;">
                                    <colgroup>
                                        <col style="width: 25%;">
                                        <col style="width: 25%;">
                                        <col style="width: 25%;">
                                        <col style="width: 25%;">
                                    </colgroup>
                                    
                                    <thead>
                                        <tr>
                                            <td colspan="4" class="text-center bg-success text-white">Evaluación de Jefatura</td>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if($revision->labor_actual)
                                            <tr>
                                                <td><strong>Labor Actual</strong></td>
                                                <td colspan="3">{{ $revision->labor_actual }}</td>
                                            </tr>
                                        @endif

                                        @if($revision->labores_desempenadas)
                                            <tr>
                                                <td><strong>Labores Desempeñadas</strong></td>
                                                <td colspan="3">{{ $revision->labores_desempenadas }}</td>
                                            </tr>
                                        @endif

                                        @if($revision->calidad_labor)
                                            <tr>
                                                <td><strong>Calidad Labor</strong></td>
                                                <td>{{ $revision->calidad_labor }}</td>
                                                <td><strong>Cumplimiento</strong></td>
                                                <td>{{ $revision->cumplimiento }}</td>
                                            </tr>
                                        @endif

                                        @if($revision->productividad || $revision->relaciones)
                                            <tr>
                                                <td><strong>Productividad</strong></td>
                                                <td>{{ $revision->productividad }}</td>
                                                <td><strong>Relaciones</strong></td>
                                                <td>{{ $revision->relaciones }}</td>
                                            </tr>
                                        @endif

                                        @if($revision->otras)
                                            <tr>
                                                <td><strong>Otras Observaciones</strong></td>
                                                <td colspan="3">{{ $revision->otras }}</td>
                                            </tr>
                                        @endif

                                        @if($revision->jefe_diligenciado_por || $revision->jefe_firma)
                                            <tr>
                                                <td><strong>Diligenciado por</strong></td>
                                                <td>{{ $revision->jefe_diligenciado_por }}</td>
                                                <td><strong>Firma</strong></td>
                                                <td>
                                                    @if($revision->jefe_firma)
                                                        <img src="{{ asset($revision->jefe_firma) }}" class="img-thumbnail" style="max-width: 120px; max-height: 60px;">
                                                    @else
                                                        <span class="text-muted">Sin firma registrada</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endif

                                        @if($revision->jefe_fecha || $revision->jefe_cumple)
                                            <tr>
                                                <td><strong>Fecha</strong></td>
                                                <td>{{ $revision->jefe_fecha }}</td>
                                                <td><strong>¿Cumple?</strong></td>
                                                <td>{{ $revision->jefe_cumple }}</td>
                                            </tr>
                                        @endif

                                        @if($revision->jefe_inmediato)
                                            <tr>
                                                <td><strong>Jefe Inmediato del Empleado</strong></td>
                                                <td colspan="3">
                                                    @php
                                                        $jefe_inmediato = $empleados->firstWhere('id', $revision->jefe_inmediato);
                                                    @endphp
                                                    {{ $jefe_inmediato->nombre ?? 'Sin asignación' }}
                                                </td>
                                            </tr>
                                        @endif

                                        @if($revision->asignado_gerencia)
                                            <tr>
                                                <td><strong>Asignado Gerencia</strong></td>
                                                <td colspan="3">
                                                    @php
                                                        $gerente = $empleados->firstWhere('id', $revision->asignado_gerencia);
                                                    @endphp
                                                    {{ $gerente->nombre ?? 'Sin asignación' }}
                                                </td>
                                            </tr>
                                        @endif

                                        <tr>
                                            <td><strong>Estado de Revisión</strong></td>
                                            <td colspan="3">
                                                <input hidden type="text" name="estado" value="gerencia" readonly>
                                                Revisado por Jefe Área
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pestaña de Gerencia -->
                <div class="tab-pane fade" id="v-pills-gerencia" role="tabpanel" aria-labelledby="v-pills-gerencia-tab">
                    <form method="POST" action="{{ route('revision_desempeno.update.gerencia', $revision->id) }}" enctype="multipart/form-data" class="needs-validation" novalidate>
                        @csrf
                        @method('PUT')

                        <div class="card shadow-sm">
                            <div class="card-body p-0">
                                <table class="table table-bordered table-hover">
                                    <!-- Encabezado -->
                                    <thead class="bg-success text-white">
                                        <tr>
                                            <th colspan="2" class="text-center h5">Evaluación de Gerencia</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <!-- Fecha -->
                                        <tr>
                                            <td class="align-middle" style="width: 25%;">
                                                <label for="fecha_gerencia" class="mb-0 font-weight-bold">Fecha</label>
                                            </td>
                                            <td>
                                                <input type="date" name="fecha_gerencia" class="form-control" 
                                                    value="{{ $revision->fecha_gerencia ?? now()->toDateString() }}">
                                            </td>
                                        </tr>

                                        <!-- ¿Cumple? -->
                                        <tr>
                                            <td class="align-middle">
                                                <label for="gerencia_cumple" class="mb-0 font-weight-bold">¿Cumple?</label>
                                            </td>
                                            <td>
                                                <select name="gerencia_cumple" class="form-control">
                                                    <option value="">Seleccione</option>
                                                    <option value="Si" {{ $revision->gerencia_cumple == 'Si' ? 'selected' : '' }}>Sí</option>
                                                    <option value="No" {{ $revision->gerencia_cumple == 'No' ? 'selected' : '' }}>No</option>
                                                </select>
                                            </td>
                                        </tr>

                                        <!-- Observaciones -->
                                        <tr>
                                            <td class="align-middle">
                                                <label for="observaciones_gerencia" class="mb-0 font-weight-bold">Observaciones</label>
                                            </td>
                                            <td>
                                                <textarea name="observaciones_gerencia" class="form-control" rows="3">{{ $revision->observaciones_gerencia }}</textarea>
                                            </td>
                                        </tr>

                                        <!-- Autorizado Por -->
                                        <tr>
                                            <td class="align-middle">
                                                <label for="autorizado_por" class="mb-0 font-weight-bold">Autorizado Por</label>
                                            </td>
                                            <td>
                                                <input type="text" name="autorizado_por" class="form-control" 
                                                    value="{{ auth()->user()->name ?? $revision->autorizado_por }}" readonly>
                                            </td>
                                        </tr>

                                        <!-- Separador -->
                                        <tr class="bg-light">
                                            <td colspan="2" class="text-center font-weight-bold">Elaborado / Revisado / Aprobado</td>
                                        </tr>

                                        <!-- Elaborado Por -->
                                        <tr>
                                            <td class="align-middle">
                                                <label for="elaborado_por" class="mb-0 font-weight-bold">Elaborado Por</label>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" value="{{ $revision->gh_diligenciado_por ?? 'Sin asignar' }}" readonly>
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <td class="align-middle">
                                                <label for="revisado_por" class="mb-0 font-weight-bold">Revisado Por</label>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" value="{{ $revision->revisado->name ?? 'Sin asignar' }}" readonly>
                                            </td>
                                        </tr>
                                        

                                        <!-- Aprobado Por -->
                                        <tr>
                                            <td class="align-middle">
                                                <label for="aprobado_por" class="mb-0 font-weight-bold">Aprobado Por</label>
                                            </td>
                                            <td>
                                                <div class="col-md-6">                                  
                                                    <input style="width: 280px" type="text" class="form-control" value="{{ Auth::user()->name }}" readonly>
                                                    <input type="hidden" name="aprobado_por" value="{{ Auth::user()->id }}">
                                                </div><br><br>
                                            </td>
                                        </tr>

                                        <!-- Fecha Aprobación -->
                                        <tr>
                                            <td class="align-middle">
                                                <label for="fecha_aprobacion" class="mb-0 font-weight-bold">Fecha Aprobación</label>
                                            </td>
                                            <td>
                                                <input type="date" name="fecha_aprobacion"  value="{{ date('Y-m-d') }}" class="form-control" >
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle">
                                                <label for="jefe_firma" class="mb-0 font-weight-bold">Firma</label>
                                            </td>
                                            <td>
                                                <!-- Previsualización de la firma -->
                                                <div id="firma_autorizado-container">
                                                    @if($revision->firma_autorizado)
                                                        <img src="{{ asset($revision->firma_autorizado) }}" id="firma_autorizado-preview" 
                                                            style="max-width: 150px; max-height: 80px; border: 1px solid #ddd; margin-bottom: 10px;">
                                                    @else
                                                        <div id="firma_autorizado-preview" style="width: 150px; height: 80px; border: 1px dashed #ccc; 
                                                                display: flex; align-items: center; justify-content: center; color: #999; margin-bottom: 10px;">
                                                            Vista previa de la firma
                                                        </div>
                                                    @endif
                                                </div>
                                                
                                                <!-- Input para cargar la firma -->
                                                <input type="file" name="firma_autorizado" id="firma_autorizado" accept="image/*" class="form-control">
                                                <small class="text-muted">Formatos aceptados: JPG, PNG (Máx. 2MB)</small>
                                                
                                                <!-- Campo oculto para mantener la firma existente -->
                                                @if($revision->firma_autorizado1)
                                                    <input type="hidden" name="firma_autorizado_actual" value="{{ $revision->firma_autorizado }}">
                                                @endif
                                            </td>
                                        </tr>
                                    <tr>

                                        <tr>
                                            <td colspan="3" class="align-middle">
                                                <div class="col-md-6">
                                                    <label for="fecha_vencimiento"><span style="color: #218838">Estado de Revision :</span></label>
                                                    <input hidden type="text" name="estado" class="form-control" value="terminado" placeholder="Pendiente Gestion Humana" readonly>
                                                    <p>Pendiente por Aprobar Gerencia</p>
                                                </div>
                                            </td>
                                        </tr>
                            
                                        <!-- Botón de envío -->
                                        <tr>
                                            <td colspan="2" class="text-center bg-light">
                                                <button type="submit" class="btn btn-success ">
                                                    <i class="fas fa-save mr-2"></i>Guardar Sección Gerencia
                                                </button>
                                                <button class="btn btn-warning btn-sm" onclick="window.location='{{ url()->previous() }}'" style="margin-bottom: 5px !important; background:#ab4d1a;">
                <i class="fas fa-edit"></i> Cancelar
            </button><br>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
        <br><br>

            
        </div>
        <script>
            document.querySelector('input[name="numero_documento_trabajador"]').addEventListener('change', function () {
                const documento = this.value;
            
                fetch(`/buscar-empleado/${documento}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'found') {
                            document.querySelector('input[name="codigo"]').value = data.empleado.numero_contrato;
                            document.querySelector('input[name="numero_documento_trabajador"]').value = data.empleado.codigo;
                            document.querySelector('input[name="nombre_trabajador"]').value = data.empleado.nombre;
                            document.querySelector('input[name="labor"]').value = data.empleado.labor ?? ''; // si no hay, queda vacío
                        } else {
                            alert('El usuario no existe. Por favor crear empleado para continuar .');
                            window.location.href = '/empleados/create'; // ajusta a tu ruta real
                        }
                    });
            });
            </script>

            
        <script>
            const cedula = '{{ $revision->cedula }}';
        
            // Buscar faltas disciplinarias
            fetch(`/buscar-faltas/${cedula}`)
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'found') {
                        document.querySelector('input[name="faltas_disciplinarias"]').value = data.total;
                        const btnFaltas = document.getElementById('verFaltasBtn');
                        btnFaltas.href = data.detalle_url;
                        btnFaltas.style.display = 'inline-block';
                    } else {
                        document.querySelector('input[name="faltas_disciplinarias"]').value = 0;
                        document.getElementById('verFaltasBtn').style.display = 'none';
                    }
                });
                

                

                // Buscar llamados de atención
                fetch(`/buscar-llamados/${cedula}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'found') {
                            document.querySelector('input[name="llamados_atencion"]').value = data.total;
                            const btn = document.getElementById('verLlamadosBtn');
                            btn.href = data.detalle_url;
                            btn.style.display = 'inline-block';
                        } else {
                            document.querySelector('input[name="llamados_atencion"]').value = 0;
                            document.getElementById('verLlamadosBtn').style.display = 'none';
                        }
                    });


                    



                    fetch(`/revision/inasistencias/${cedula}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'found') {
                                document.querySelector('input[name="inasistencias"]').value = data.total;
                                const btnFaltas = document.getElementById('verInasistenciasBtn');
                                btnFaltas.href = data.detalle_url;
                                btnFaltas.style.display = 'inline-block';
                            } else {
                                document.querySelector('input[name="inasistencias"]').value = 0;
                                document.getElementById('verInasistenciasBtn').style.display = 'none';
                            }
                        });




                        fetch(`/revision/sansiones/${cedula}`)
                            .then(response => {
                                if (!response.ok) {
                                    // Si la respuesta no es 2xx, lanzamos error
                                    throw new Error(`HTTP error! status: ${response.status}`);
                                }
                                return response.json();
                            })
                            .then(data => {
                                console.log('Respuesta:', data); // Para depuración
                                
                                if (data.status === 'error') {
                                    throw new Error(data.message);
                                }

                                const inputSanciones = document.querySelector('input[name="sanciones"]');
                                const btnFaltas = document.getElementById('verSancionesBtn');
                                
                                if (data.status === 'found') {
                                    inputSanciones.value = data.total;
                                    btnFaltas.href = data.detalle_url;
                                    btnFaltas.style.display = 'inline-block';
                                } else {
                                    inputSanciones.value = '0';
                                    btnFaltas.style.display = 'none';
                                }
                            })
                            .catch(error => {
                                console.error('Error en la petición:', error);
                                document.querySelector('input[name="sanciones"]').value = 'Error';
                                
                                // Opcional: Mostrar mensaje al usuario
                                alert('Error al cargar sanciones: ' + error.message);
                            });


                            fetch(`/revision/suspenciones/${cedula}`)
                            .then(response => response.json())
                            .then(data => {
                                if (data.status === 'found') {
                                    document.querySelector('input[name="suspenciones"]').value = data.total;
                                    const btnFaltas = document.getElementById('verSuspencionesBtn');
                                    btnFaltas.href = data.detalle_url;
                                    btnFaltas.style.display = 'inline-block';
                                } else {
                                    document.querySelector('input[name="suspenciones"]').value = 0;
                                    document.getElementById('verSuspencionesBtn').style.display = 'none';
                                }
                            });





        </script>
            @if (session('errores'))
            <div class="alert alert-warning">
                <strong>Errores durante la importación:</strong>
                <ul>
                    @foreach (session('errores') as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @if (session('log_file'))
                    <a href="{{ url('descargar-log/' . session('log_file')) }}" class="btn btn-sm btn-outline-primary mt-2">
                        Descargar registro de errores
                    </a>
                @endif
            </div>
        @endif
        
            
        <style>
            
/* Contenedor principal */
.container {
    width: 80%;
    max-width: 800px;
    background: white;
    padding: 20px;
    margin: 20px auto;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

/* Título principal */
.titulo-principal {
    text-align: center;
    color: #333;
    font-size: 24px;
    margin-bottom: 20px;
}

/* Secciones */
.seccion {
    border: 2px solid #ddd;
    background: #fafafa;
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 8px;
}

/* Títulos de las secciones */
.titulo-seccion {
    background: #218838;
    color: white;
    padding: 10px;
    margin: -15px -15px 15px -15px;
    border-radius: 8px 8px 0 0;
    font-size: 18px;
}

/* Campos de entrada */
input, select {
    width: 100%;
    padding: 8px;
    margin-top: 5px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

/* Botón */
.boton-guardar {
    text-align: center;
}

button {
    background: #28a745;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

button:hover {
    background: #218838;
}
        </style>
</div>
<script>
    document.getElementById('firma_autorizado').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const preview = document.getElementById('firma_autorizado-preview');
    const container = document.getElementById('firma_autorizado-container');
    
    if (file) {
        // Validar tipo de archivo
        if (!file.type.match('image.*')) {
            alert('Por favor seleccione una imagen válida (JPEG, PNG)');
            this.value = ''; // Limpiar el input
            return;
        }
        
        // Validar tamaño (2MB)
        if (file.size > 2048 * 1024) {
            alert('La imagen no debe exceder 2MB');
            this.value = '';
            return;
        }
        
        // Mostrar previsualización
        const reader = new FileReader();
        reader.onload = function(event) {
            if (preview.tagName === 'IMG') {
                preview.src = event.target.result;
            } else {
                container.innerHTML = '';
                const img = document.createElement('img');
                img.id = 'firma_autorizado-preview';
                img.src = event.target.result;
                img.style.maxWidth = '150px';
                img.style.maxHeight = '80px';
                img.style.border = '1px solid #ddd';
                img.style.marginBottom = '10px';
                container.appendChild(img);
            }
        };
        reader.readAsDataURL(file);
    }
});
</script>
<x-footer />

</x-app-layout>

