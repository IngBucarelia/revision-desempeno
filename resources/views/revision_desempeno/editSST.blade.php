<x-app-layout>
    <x-appbar />

    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css_dascboard.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <div class="contenedor-principal">
        <x-sidebar />
        <div class="container">
            <h2 class="text-center mb-4">Revisión de Desempeño - Sección SST</h2>
            
            <div class="row">
                <!-- Pestañas verticales -->
                <div class="col-md-3">
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
                            <form method="POST" action="{{ route('revision_desempeno.update.sst', $revision->id) }}" enctype="multipart/form-data" class="needs-validation" novalidate>
                                @csrf
                                @method('PUT')
                                
                                <div class="card shadow-sm">
                                    <div class="card-body p-0">
                                        <table class="table table-bordered table-hover">
                                            <thead class="bg-success text-white">
                                                <tr>
                                                    <th colspan="2" class="text-center h5">Datos de Seguridad y Salud en el Trabajo (SST)</th>
                                                </tr>
                                            </thead>
                                    
                                            <tbody>
                                                <!-- Cumplimiento SG-SST -->
                                                <tr>
                                                    <td class="align-middle" style="width: 25%;">
                                                        <label for="cumplimiento_sgsst" class="mb-0 font-weight-bold">Cumplimiento SG-SST</label>
                                                    </td>
                                                    <td>
                                                        <textarea name="cumplimiento_sgsst" class="form-control" rows="4" require>{{ $revision->cumplimiento_sgsst }}</textarea>
                                                    </td>
                                                </tr>
                                    
                                                <!-- Hábitos y Comportamientos -->
                                                <tr>
                                                    <td class="align-middle">
                                                        <label for="habitos_comportamientos" class="mb-0 font-weight-bold">Hábitos y Comportamientos</label>
                                                    </td>
                                                    <td>
                                                        <textarea name="habitos_comportamientos" class="form-control" require rows="4">{{ $revision->habitos_comportamientos }}</textarea>
                                                    </td>
                                                </tr>
                                    
                                                <!-- Diligenciado por -->
                                                <tr>
                                                    <td class="align-middle">
                                                        <label for="sst_diligenciado_por" class="mb-0 font-weight-bold">Diligenciado por</label>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="sst_diligenciado_por" class="form-control" require
                                                               value="{{ auth()->user()->name ?? $revision->sst_diligenciado_por }}" readonly>
                                                    </td>
                                                </tr>
                                    
                                                <!-- Fecha -->
                                                <tr>
                                                    <td class="align-middle">
                                                        <label for="sst_fecha" class="mb-0 font-weight-bold">Fecha</label>
                                                    </td>
                                                    <td>
                                                        <input type="date" name="sst_fecha" class="form-control" require
                                                               value="{{ $revision->sst_fecha ?? now()->toDateString() }}">
                                                    </td>
                                                </tr>
                                    
                                                <!-- ¿Cumple con SST? -->
                                                <tr>
                                                    <td class="align-middle">
                                                        <label for="sst_cumple" class="mb-0 font-weight-bold">¿Cumple con SST?</label>
                                                    </td>
                                                    <td>
                                                        <select name="sst_cumple" class="form-control" require>
                                                            <option value="">Seleccione</option>
                                                            <option value="Si" {{ $revision->sst_cumple == 'Si' ? 'selected' : '' }}>Sí</option>
                                                            <option value="No" {{ $revision->sst_cumple == 'No' ? 'selected' : '' }}>No</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                    
                                                <!-- Jefe Inmediato -->
                                                <tr>
                                                    <td class="align-middle">
                                                        <label for="jefe" class="mb-0 font-weight-bold">Jefe Inmediato</label>
                                                    </td>
                                                    <td>
                                                        <select name="jefe" class="form-control" required>
                                                            <option value="">Seleccione</option>
                                                            @foreach($empleados as $empleado)
                                                                <option value="{{ $empleado->id }}" {{ $revision->jefe == $empleado->id ? 'selected' : '' }}>
                                                                    {{ $empleado->nombre }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                </tr>
                                                
                                                <!-- Firma -->
                                                <tr>
                                                    <td class="align-middle">
                                                        <label for="sst_firma" class="mb-0 font-weight-bold">Firma</label>
                                                    </td>
                                                    <td>
                                                        <!-- Previsualización de la firma -->
                                                        <div id="sst-firma-container">
                                                            @if($revision->sst_firma)
                                                                <img src="{{ asset($revision->sst_firma) }}" id="sst-firma-preview" 
                                                                    style="max-width: 150px; max-height: 80px; border: 1px solid #ddd; margin-bottom: 10px;">
                                                            @else
                                                                <div id="sst-firma-preview" style="width: 150px; height: 80px; border: 1px dashed #ccc; 
                                                                        display: flex; align-items: center; justify-content: center; color: #999; margin-bottom: 10px;">
                                                                    Vista previa de la firma
                                                                </div>
                                                            @endif
                                                        </div>
                                                        
                                                        <!-- Input para cargar la firma -->
                                                        <input type="file" name="sst_firma" id="sst_firma" accept="image/*" class="form-control" require>
                                                        <small class="text-muted">Formatos aceptados: JPG, PNG (Máx. 2MB)</small>
                                                        
                                                        <!-- Campo oculto para mantener la firma existente -->
                                                        @if($revision->sst_firma)
                                                            <input type="hidden" name="sst_firma_actual" value="{{ $revision->sst_firma }}">
                                                        @endif
                                                    </td>
                                                </tr>
                                    
                                                <tr>
                                                    <td colspan="3" class="align-middle">
                                                        <div class="col-md-6">
                                                            <label for="fecha_vencimiento"><span style="color: #218838">Estado de Revision :</span></label>
                                                            <input hidden type="text" name="estado" class="form-control" value="jefe" placeholder="Pendiente Gestion Humana" readonly>
                                                            <p>Pendiente Seguridad Salud en el Trabajo</p>
                                                        </div>
                                                    </td>
                                                </tr>
                                    
                                                <!-- Botón de envío -->
                                                <tr>
                                                    <td colspan="2" class="text-center bg-light">
                                                        <button type="submit" class="btn btn-success ">
                                                            <i class="fas fa-save mr-2"></i>Guardar <br>
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

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        .nav-pills .nav-link {
            border-radius: 0.25rem;
            padding: 0.75rem 1rem;
            margin-bottom: 0.5rem;
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
            min-height: 120px;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            resize: vertical;
        }
    </style>

    <script>
        // Script para previsualización de firma
        document.getElementById('sst_firma').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const preview = document.getElementById('sst-firma-preview');
            const container = document.getElementById('sst-firma-container');
            
            if (file) {
                if (!file.type.match('image.*')) {
                    alert('Por favor selecciona una imagen válida (JPEG, PNG)');
                    return;
                }
                
                const reader = new FileReader();
                reader.onload = function(event) {
                    if (preview.tagName === 'IMG') {
                        preview.src = event.target.result;
                    } else {
                        container.innerHTML = '';
                        const img = document.createElement('img');
                        img.id = 'sst-firma-preview';
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

        // Script para cargar datos de faltas, sanciones, etc.
        document.addEventListener('DOMContentLoaded', function() {
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

            // Buscar inasistencias
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

            // Buscar sanciones
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



            // Buscar suspensiones
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

            // Mostrar modal si hay registro exitoso
            
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
                    ¡Los datos de SST se han guardado correctamente!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Aceptar</button>
                </div>
            </div>
        </div>
    </div>

    <x-footer />
</x-app-layout>