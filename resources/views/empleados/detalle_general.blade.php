<x-app-layout>
    <x-appbar />
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css_dascboard.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <div class="contenedor-principal">
        <x-sidebar />
        <div class="container mt-4">
            <h2 class="mb-4 text-center text-success">👤 Detalle del Empleado</h2>

            {{-- Navegación por pestañas --}}
            <ul class="nav nav-tabs mb-4" id="empleadoTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active bg-success text-white" id="info-tab" data-bs-toggle="tab" data-bs-target="#info" type="button" role="tab" aria-controls="info" aria-selected="true">
                        Información Personal
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link bg-warning text-dark" id="llamados-tab" data-bs-toggle="tab" data-bs-target="#llamados" type="button" role="tab" aria-controls="llamados" aria-selected="false">
                        📌 Llamados
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link bg-danger text-white" id="faltas-tab" data-bs-toggle="tab" data-bs-target="#faltas" type="button" role="tab" aria-controls="faltas" aria-selected="false">
                        🚫 Faltas
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link bg-secondary text-white" id="suspensiones-tab" data-bs-toggle="tab" data-bs-target="#suspensiones" type="button" role="tab" aria-controls="suspensiones" aria-selected="false">
                        ⛔ Suspensiones
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link bg-info text-white" id="sanciones-tab" data-bs-toggle="tab" data-bs-target="#sanciones" type="button" role="tab" aria-controls="sanciones" aria-selected="false">
                        ⚠️ Inasistencias
                    </button>
                </li>
            </ul>

            {{-- Contenido de las pestañas --}}
            <div class="tab-content" id="empleadoTabsContent">
                {{-- Información Personal --}}
                <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info-tab">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr><th>Código</th><td>{{ $empleado->codigo }}</td></tr>
                                <tr><th>Nombre</th><td>{{ $empleado->nombre }}</td></tr>
                                <tr><th>Fecha Ingreso</th><td>{{ $empleado->fecha_ingreso }}</td></tr>
                                <tr><th>Labor</th><td>{{ $empleado->labor }}</td></tr>
                                <tr><th>Rol</th><td>{{ $empleado->rol }}</td></tr>
                                <tr><th>Periodo Prueba</th><td>{{ $empleado->periodo_prueba }}</td></tr>
                                <tr><th>Contrato</th><td>{{ $empleado->numero_contrato }}</td></tr>
                                <tr><th>Correo</th><td>{{ $empleado->correo }}</td></tr>
                                <tr><th>Teléfono</th><td>{{ $empleado->telefono }}</td></tr>
                                <tr><th>Estado Civil</th><td>{{ $empleado->estado_civil }}</td></tr>
                                <tr><th>Fecha Terminación</th><td>{{ $empleado->fecha_terminacion ?? 'N/A' }}</td></tr>
                                <tr><th>Jefe</th><td>{{ optional(\App\Models\Empleado::find($empleado->id_jefe))->nombre ?? 'No asignado' }}</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Llamados de Atención --}}
                <div class="tab-pane fade" id="llamados" role="tabpanel" aria-labelledby="llamados-tab">
                    @if ($llamados->count())
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover align-middle tabla-llamados">
                                <thead class="table-success text-center">
                                    <tr>
                                        <th>Asunto</th>
                                        <th>Fecha Notificación</th>
                                        <th>Fecha Falta</th>
                                        <th>Observaciones</th>
                                        <th>Descripción</th>
                                        <th>Adjunto</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($llamados as $llamado)
                                        <tr>
                                            <td><strong>{{ $llamado->asunto }}</strong></td>
                                            <td>{{ $llamado->fecha_notificacion }}</td>
                                            <td>{{ $llamado->fecha_falta }}</td>
                                            <td class="truncate-text">{{ $llamado->observaciones }}</td>
                                            <td class="truncate-text">{{ $llamado->descripcion_falta }}</td>
                                            <td class="text-center">
                                                @if ($llamado->pdf_evidencia)
                                                    <a href="{{ $llamado->pdf_evidencia }}" target="_blank">📄 Ver</a>
                                                @else
                                                    <span class="text-muted">Sin archivo</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted">No hay llamados registrados.</p>
                    @endif
                </div>

                {{-- Faltas Disciplinarias --}}
                <div class="tab-pane fade" id="faltas" role="tabpanel" aria-labelledby="faltas-tab">
                    @if ($faltas->count())
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <td><strong>Clase Falta:</strong></td>
                                        <td><strong>Tipo Falta:</strong></td>
                                        <td><strong>Fecha Reporte:</strong></td>
                                        <td><strong>Descripción:</strong></td>
                                        <td><strong>Evidencias:</strong></td>
                                        <td><strong>Adjunto:</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($faltas as $falta)
                                        <tr>
                                            <td><strong>{{ $falta->clase_falta }}</strong></td>
                                            <td><strong>{{ $falta->tipo_falta }}</strong></td>
                                            <td>{{ $falta->fecha_reporte }}</td>
                                            <td>{{ $falta->descripcion_falta }}</td>
                                            <td>{{ $falta->evidencias_adicionales }}</td>
                                            <td><a href="{{ $falta->pdf_evidencia }}" target="blank">Ver Documento</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted">No hay faltas registradas.</p>
                    @endif
                </div>

                {{-- Suspensiones --}}
                <div class="tab-pane fade" id="suspensiones" role="tabpanel" aria-labelledby="suspensiones-tab">
                    @if ($suspenciones->count())
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <td><strong>Inicio:</strong></td>
                                        <td><strong>Fin:</strong></td>
                                        <td><strong>Total de Días:</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($suspenciones as $susp)
                                        <tr>
                                            <td>{{ $susp->fecha_inicio }}</td>
                                            <td>{{ $susp->fecha_fin }}</td>
                                            <td>{{ $susp->total_dias }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted">No hay suspensiones registradas.</p>
                    @endif
                </div>

                {{-- Sanciones --}}
                <div class="tab-pane fade" id="sanciones" role="tabpanel" aria-labelledby="sanciones-tab">
                    @if ($sanciones->count())
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <td><strong>Inicio:</strong></td>
                                        <td><strong>Fin:</strong></td>
                                        <td><strong>Total de Días:</strong></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sanciones as $sancion)
                                        <tr>
                                            <td>{{ $sancion->fecha_inicio }}</td>
                                            <td>{{ $sancion->fecha_fin }}</td>
                                            <td>{{ $sancion->total_dias }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted">No hay sanciones registradas.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <style>
        .nav-tabs .nav-link {
            font-weight: bold;
            padding: 25px 40px;
            border: none;
            margin-right: 5px;
            border-radius: 0.25rem 0.25rem 0 0;
        }
        .nav-tabs .nav-link.active {
            color: white !important;
            border-bottom: 3px solid #0d6efd;
        }
        .nav-tabs .nav-link:not(.active) {
            opacity: 0.8;
        }
        .nav-tabs .nav-link:hover {
            opacity: 1;
        }
        .table-responsive {
            overflow-x: auto;
            width: 100%;
        }
        .tabla-llamados th,
        .tabla-llamados td {
            word-wrap: break-word;
            white-space: normal;
            max-width: 200px;
            text-align: justify;
            vertical-align: top;
        }
        .truncate-text {
            max-width: 200px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .tab-content {
            padding: 20px;
            border: 1px solid #dee2e6;
            border-top: none;
            border-radius: 0 0 0.25rem 0.25rem;
        }
    </style>

    <x-footer />

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</x-app-layout>