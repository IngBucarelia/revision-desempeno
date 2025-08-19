<x-app-layout>
    <x-appbar />

    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css_dascboard.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <div class="contenedor-principal">
        <x-sidebar />
        <div class="container mt-4 d-flex flex-column align-items-center" style="margin-bottom: 300px">
            <div class="contenido w-100">    
                <h2 class="text-center mb-4">Sección Jefatura</h2>

                <div class="row">
                    <!-- Pestañas verticales -->
                    <div class="col-md-3">
                        <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <button style="height: 80px; background-color:#218838"class="nav-link active mb-2 text-start" id="v-pills-general-tab" data-bs-toggle="pill" data-bs-target="#v-pills-general" type="button" role="tab" aria-controls="v-pills-general" aria-selected="true">
                                <i class="bi bi-person-lines-fill me-2"></i> Información General
                            </button>
                            <button style="height: 80px; background-color:#218838" class="nav-link mb-2 text-start" id="v-pills-gh-tab" data-bs-toggle="pill" data-bs-target="#v-pills-gh" type="button" role="tab" aria-controls="v-pills-gh" aria-selected="false">
                                <i class="bi bi-people-fill me-2"></i> Gestión Humana
                            </button>
                            <button style="height: 80px; background-color:#218838" class="nav-link mb-2 text-start" id="v-pills-sst-tab" data-bs-toggle="pill" data-bs-target="#v-pills-sst" type="button" role="tab" aria-controls="v-pills-sst" aria-selected="false">
                                <i class="bi bi-shield-check me-2"></i> Seguridad y Salud
                            </button>
                            <button style="height: 80px; background-color:#218838" class="nav-link mb-2 text-start" id="v-pills-jefatura-tab" data-bs-toggle="pill" data-bs-target="#v-pills-jefatura" type="button" role="tab" aria-controls="v-pills-jefatura" aria-selected="false">
                                <i class="bi bi-person-badge me-2"></i> Evaluación Jefatura
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

                            <!-- Pestaña de Evaluación Jefatura -->
                            <div class="tab-pane fade" id="v-pills-jefatura" role="tabpanel" aria-labelledby="v-pills-jefatura-tab">
                                <form method="POST" action="{{ route('revision_desempeno.update.jefe', $revision->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    
                                    <div class="card shadow-sm">
                                        <div class="card-body p-0">
                                            <table class="table table-bordered table-hover">
                                                <thead class="bg-success text-white">
                                                    <tr>
                                                        <th colspan="2" class="text-center h5">Evaluación de Jefatura</th>
                                                    </tr>
                                                </thead>
                                        
                                                <tbody>
                                                    <!-- Labor Actual -->
                                                    <tr>
                                                        <td class="align-middle" style="width: 25%;">
                                                            <label for="labor_actual" class="mb-0 font-weight-bold">Labor Actual</label>
                                                        </td>
                                                        <td>
                                                            <textarea name="labor_actual" class="form-control" rows="3">{{ $revision->labor_actual }}</textarea>
                                                        </td>
                                                    </tr>
                                        
                                                    <!-- Labores Desempeñadas -->
                                                    <tr>
                                                        <td class="align-middle">
                                                            <label for="labores_desempenadas" class="mb-0 font-weight-bold">Labores Desempeñadas</label>
                                                        </td>
                                                        <td>
                                                            <textarea name="labores_desempenadas" class="form-control" rows="3">{{ $revision->labores_desempenadas }}</textarea>
                                                        </td>
                                                    </tr>
                                        
                                                    <!-- Calidad Labor -->
                                                    <tr>
                                                        <td class="align-middle">
                                                            <label for="calidad_labor" class="mb-0 font-weight-bold">Calidad Labor</label>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="calidad_labor" class="form-control" value="{{ $revision->calidad_labor }}">
                                                        </td>
                                                    </tr>
                                        
                                                    <!-- Cumplimiento -->
                                                    <tr>
                                                        <td class="align-middle">
                                                            <label for="cumplimiento" class="mb-0 font-weight-bold">Cumplimiento</label>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="cumplimiento" class="form-control" value="{{ $revision->cumplimiento }}">
                                                        </td>
                                                    </tr>
                                        
                                                    <!-- Productividad -->
                                                    <tr>
                                                        <td class="align-middle">
                                                            <label for="productividad" class="mb-0 font-weight-bold">Productividad</label>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="productividad" class="form-control" value="{{ $revision->productividad }}">
                                                        </td>
                                                    </tr>
                                        
                                                    <!-- Relaciones -->
                                                    <tr>
                                                        <td class="align-middle">
                                                            <label for="relaciones" class="mb-0 font-weight-bold">Relaciones</label>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="relaciones" class="form-control" value="{{ $revision->relaciones }}">
                                                        </td>
                                                    </tr>
                                        
                                                    <!-- Otras Observaciones -->
                                                    <tr>
                                                        <td class="align-middle">
                                                            <label for="otras" class="mb-0 font-weight-bold">Otras Observaciones</label>
                                                        </td>
                                                        <td>
                                                            <textarea name="otras" class="form-control" rows="3">{{ $revision->otras }}</textarea>
                                                        </td>
                                                    </tr>
                                        
                                                    <!-- Diligenciado por -->
                                                    <tr>
                                                        <td class="align-middle">
                                                            <label for="jefe_diligenciado_por" class="mb-0 font-weight-bold">Diligenciado por</label>
                                                        </td>
                                                        <td>
                                                            <input type="text" name="jefe_diligenciado_por" class="form-control" 
                                                                   value="{{ auth()->user()->name ?? $revision->jefe_diligenciado_por }}" readonly>
                                                        </td>
                                                    </tr>
                                        
                                                    <!-- Fecha -->
                                                    <tr>
                                                        <td class="align-middle">
                                                            <label for="jefe_fecha" class="mb-0 font-weight-bold">Fecha</label>
                                                        </td>
                                                        <td>
                                                            <input type="date" name="jefe_fecha" class="form-control" value="{{ $revision->jefe_fecha ?? now()->toDateString() }}">
                                                        </td>
                                                    </tr>
                                        
                                                    <!-- ¿Cumple? -->
                                                    <tr>
                                                        <td class="align-middle">
                                                            <label for="jefe_cumple" class="mb-0 font-weight-bold">¿Cumple?</label>
                                                        </td>
                                                        <td>
                                                            <select name="jefe_cumple" class="form-control">
                                                                <option value="">Seleccione</option>
                                                                <option value="Si" {{ $revision->jefe_cumple == 'Si' ? 'selected' : '' }}>Sí</option>
                                                                <option value="No" {{ $revision->jefe_cumple == 'No' ? 'selected' : '' }}>No</option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <!-- Asignado jefe inmediato  -->
                                                    <tr>
                                                        <td class="align-middle">
                                                            <label for="asignado_gerencia" class="mb-0 font-weight-bold">Jefe inmediato del Empleado</label>
                                                        </td>
                                                        <td>
                                                <input type="text" name="jefe_inmediato">

                                                            
                                                        </td>
                                                    </tr>
                                        
                                                    <!-- Asignado Gerencia -->
                                                    <tr>
                                                        <td class="align-middle">
                                                            <label for="asignado_gerencia" class="mb-0 font-weight-bold">Asignado Gerencia</label>
                                                        </td>
                                                        <td>
                                                            <select name="asignado_gerencia" class="form-control" required>
                                                                <option value="">Seleccione</option>
                                                                @foreach($empleados as $empleado)
                                                                    <option value="{{ $empleado->id }}" {{ $revision->asignado_gerencia == $empleado->id ? 'selected' : '' }}>
                                                                        {{ $empleado->nombre }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3" class="align-middle">
                                                            <div class="col-md-6">
                                                                <label for="elaborado_por">Revisado Por:</label>
                                                                <input type="text" class="form-control" value="{{ Auth::user()->name }}" readonly>
                                                                <input type="hidden" name="revisado_por" value="{{ Auth::user()->id }}">
                                                            </div><br><br>
                                                        </td>
                                                    </tr>
                                                    <!-- Firma Jefe -->
                                                    <tr>
                                                        <td class="align-middle">
                                                            <label for="jefe_firma" class="mb-0 font-weight-bold">Firma</label>
                                                        </td>
                                                        <td>
                                                            <!-- Previsualización de la firma -->
                                                            <div id="jefe-firma-container">
                                                                @if($revision->jefe_firma)
                                                                    <img src="{{ asset($revision->jefe_firma) }}" id="jefe-firma-preview" 
                                                                        style="max-width: 150px; max-height: 80px; border: 1px solid #ddd; margin-bottom: 10px;">
                                                                @else
                                                                    <div id="jefe-firma-preview" style="width: 150px; height: 80px; border: 1px dashed #ccc; 
                                                                            display: flex; align-items: center; justify-content: center; color: #999; margin-bottom: 10px;">
                                                                        Vista previa de la firma
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            
                                                            <!-- Input para cargar la firma -->
                                                            <input type="file" name="jefe_firma" id="jefe_firma" accept="image/*" class="form-control">
                                                            <small class="text-muted">Formatos aceptados: JPG, PNG (Máx. 2MB)</small>
                                                            
                                                            <!-- Campo oculto para mantener la firma existente -->
                                                            @if($revision->jefe_firma)
                                                                <input type="hidden" name="jefe_firma_actual" value="{{ $revision->jefe_firma }}">
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr> 
                                                        <td colspan="3" class="align-middle">
                                                            <div class="col-md-6">
                                                                <label for="fecha_vencimiento"><span style="color: #218838">Estado de Revision :</span></label>
                                                                <input hidden type="text" name="estado" class="form-control" value="gerencia" placeholder="Pendiente Gestion Humana" readonly>
                                                                <p>Pendiente Jefe Inmediato</p>
                                                            </div>
                                                        </td>
                                                    </tr>
                                        
                                                    <!-- Botón de envío -->
                                                    <tr>
                                                        <td colspan="2" class="text-center bg-light">
                                                            <button type="submit" class="btn btn-success">
                                                                <i class="fas fa-save mr-2"></i>Guardar Sección Jefatura
                                                            </button>
                                                            <button class="btn btn-warning btn-sm ms-2" onclick="window.location='{{ url()->previous() }}'" style="background:#ab4d1a;">
                                                                <i class="fas fa-edit"></i> Cancelar
                                                            </button>
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
        </div>
    </div>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        .nav-pills .nav-link {
            border-radius: 0.25rem;
            padding: 2.75rem 1rem;
            margin-bottom: 1.5rem;
            background-color: #f8f9fa;
            color: #212529;
            font-weight: 500;
            transition: all 0.3s ease;
            text-align: left;
        }

        .nav-pills .nav-link.active {
            background-color: #198754;
            color: white;
        }

        .nav-pills .nav-link:hover:not(.active) {
            background-color: #e9ecef;
        }

        .tab-content {
            padding: 0;
        }

        .card {
            border-radius: 0.5rem;
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }

        .table {
            margin-bottom: 0;
        }

        .table th, .table td {
            vertical-align: middle;
        }

        .firma-container {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .btn-info {
            background-color: #0dcaf0;
            border-color: #0dcaf0;
        }

        .textarea-estilizado {
            width: 100%;
            min-height: 100px;
            resize: vertical;
        }

        .btn-warning {
            background-color: #ab4d1a;
            border-color: #ab4d1a;
            color: white;
        }

        .img-thumbnail {
            max-width: 120px;
            max-height: 60px;
        }
    </style>

    <script>
        // Script para previsualización de firma
        document.getElementById('jefe_firma').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const preview = document.getElementById('jefe-firma-preview');
            const container = document.getElementById('jefe-firma-container');
            
            if (file) {
                if (!file.type.match('image.*')) {
                    alert('Por favor selecciona una imagen válida (JPEG, PNG)');
                    this.value = '';
                    return;
                }
                
                if (file.size > 2048 * 1024) {
                    alert('La imagen no debe exceder 2MB');
                    this.value = '';
                    return;
                }
                
                const reader = new FileReader();
                reader.onload = function(event) {
                    if (preview.tagName === 'IMG') {
                        preview.src = event.target.result;
                    } else {
                        container.innerHTML = '';
                        const img = document.createElement('img');
                        img.id = 'jefe-firma-preview';
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

        // Script para cargar datos de sanciones
        document.addEventListener('DOMContentLoaded', function() {
            const cedula = '{{ $revision->cedula }}';
            
            fetch(`/revision/sansiones/${cedula}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Respuesta:', data);
                    
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
                    alert('Error al cargar sanciones: ' + error.message);
                });

            // Mostrar modal si hay registro exitoso
            
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
    <!-- Modal de Registro Exitoso -->
    <div class="modal fade" id="registroExitoso" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">Registro Exitoso</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    ¡La evaluación de jefatura se ha guardado correctamente!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Aceptar</button>
                </div>
            </div>
        </div>
    </div>

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

    <x-footer />
</x-app-layout>