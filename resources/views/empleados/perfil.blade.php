<x-app-layout>
    <x-appbar />
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css_dascboard.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <div class="contenedor-principal">
        <x-sidebar />
        <div class="container mt-4">
            <h2 class="titulo_formulario">👤 Mi Perfil</h2>

            {{-- Navegación por pestañas --}}
            <ul class="nav nav-tabs mb-4" id="profileTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="info-tab" data-bs-toggle="tab" data-bs-target="#info" type="button" role="tab" aria-controls="info" aria-selected="true">
                        📋 Información Personal
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="llamados-tab" data-bs-toggle="tab" data-bs-target="#llamados" type="button" role="tab" aria-controls="llamados" aria-selected="false">
                        📌 Llamados de Atención
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="faltas-tab" data-bs-toggle="tab" data-bs-target="#faltas" type="button" role="tab" aria-controls="faltas" aria-selected="false">
                        🚫 Faltas Disciplinarias
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="suspensiones-tab" data-bs-toggle="tab" data-bs-target="#suspensiones" type="button" role="tab" aria-controls="suspensiones" aria-selected="false">
                        ⛔ Suspensiones
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="inasistencias-tab" data-bs-toggle="tab" data-bs-target="#inasistencias" type="button" role="tab" aria-controls="inasistencias" aria-selected="false">
                        ⚠️ Inasistencias
                    </button>
                </li>
            </ul>

            {{-- Contenido de las pestañas --}}
            <div class="tab-content" id="profileTabsContent">
                {{-- Información Personal --}}
                <div class="tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="info-tab">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped text-center">
                            <thead class="table-success">
                                <tr>
                                    <th colspan="6" class="text-center">Información Personal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>Código</strong></td>
                                    <td>{{ $empleado->codigo }}</td>
                                    <td><strong>Nombre</strong></td>
                                    <td>{{ $empleado->nombre }}</td>
                                    <td><strong>Fecha Ingreso</strong></td>
                                    <td>{{ $empleado->fecha_ingreso }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Labor</strong></td>
                                    <td>{{ $empleado->labor }}</td>
                                    <td><strong>Rol</strong></td>
                                    <td>{{ $empleado->rol }}</td>
                                    <td><strong>Periodo Prueba</strong></td>
                                    <td>{{ $empleado->periodo_prueba }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Contrato</strong></td>
                                    <td>{{ $empleado->numero_contrato }}</td>
                                    <td><strong>Correo</strong></td>
                                    <td>{{ $empleado->correo }}</td>
                                    <td><strong>Teléfono</strong></td>
                                    <td>{{ $empleado->telefono }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Estado Civil</strong></td>
                                    <td>{{ $empleado->estado_civil }}</td>
                                    <td><strong>Fecha Terminación</strong></td>
                                    <td>{{ $empleado->fecha_terminacion ?? 'N/A' }}</td>
                                    <td><strong>Jefe</strong></td>
                                    <td>{{ optional(\App\Models\Empleado::find($empleado->id_jefe))->nombre ?? 'No asignado' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Llamados de Atención --}}
                <div class="tab-pane fade" id="llamados" role="tabpanel" aria-labelledby="llamados-tab">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover text-center align-middle w-100" style="table-layout: fixed;">
                            <thead class="table-warning">
                                <tr>
                                    <th colspan="6" class="text-center">📌 Llamados de Atención</th>
                                </tr>
                                <tr>
                                    <th>Asunto</th>
                                    <th>Fecha Notificación</th>
                                    <th>Fecha Falta</th>
                                    <th style="width: 200px;">Observaciones</th>
                                    <th style="width: 200px;">Descripción</th>
                                    <th>Adjunto</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($llamados as $llamado)
                                    <tr>
                                        <td><strong>{{ $llamado->asunto }}</strong></td>
                                        <td>{{ $llamado->fecha_notificacion }}</td>
                                        <td>{{ $llamado->fecha_falta }}</td>
                                        <td style="word-wrap: break-word;">{{ $llamado->observaciones }}</td>
                                        <td style="word-wrap: break-word;">{{ $llamado->descripcion_falta }}</td>
                                        <td>
                                            @if ($llamado->pdf_evidencia)
                                                <a href="{{ $llamado->pdf_evidencia }}" target="_blank">📄 Ver Documento</a>
                                            @else
                                                <span class="text-muted">Sin archivo</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-muted text-center">No hay llamados registrados.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Faltas Disciplinarias --}}
                <div class="tab-pane fade" id="faltas" role="tabpanel" aria-labelledby="faltas-tab">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-danger text-white text-center">
                                <tr>
                                    <th colspan="6">🚫 Faltas Disciplinarias</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>Clase Falta:</strong></td>
                                    <td><strong>Tipo Falta:</strong></td>
                                    <td><strong>Fecha Reporte:</strong></td>
                                    <td><strong>Descripción:</strong></td>
                                    <td><strong>Evidencias:</strong></td>
                                    <td><strong>Adjunto:</strong></td>
                                </tr>
                                @forelse ($faltas as $falta)
                                    <tr>
                                        <td><strong>{{ $falta->clase_falta }}</strong></td>
                                        <td><strong>{{ $falta->tipo_falta }}</strong></td>
                                        <td>{{ $falta->fecha_reporte }}</td>
                                        <td>{{ $falta->descripcion_falta }}</td>
                                        <td>{{ $falta->evidencias_adicionales }}</td>
                                        <td><a href="{{ $falta->pdf_evidencia }}" target="blank">Ver Documento</a></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-muted text-center">No hay faltas registradas.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Suspensiones --}}
                <div class="tab-pane fade" id="suspensiones" role="tabpanel" aria-labelledby="suspensiones-tab">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center">
                            <thead class="table-secondary">
                                <tr>
                                    <th colspan="3">⛔ Suspensiones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>Inicio:</strong></td>
                                    <td><strong>Fin:</strong></td>
                                    <td><strong>Total de Días:</strong></td>
                                </tr>
                                @forelse ($suspenciones as $suspension)
                                    <tr>
                                        <td>{{ $suspension->fecha_inicio }}</td>
                                        <td>{{ $suspension->fecha_fin }}</td>
                                        <td>{{ $suspension->total_dias }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-muted text-center">No hay suspensiones registradas.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Inasistencias --}}
                <div class="tab-pane fade" id="inasistencias" role="tabpanel" aria-labelledby="inasistencias-tab">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center">
                            <thead class="table-info">
                                <tr>
                                    <th colspan="3">⚠️ Inasistencias</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>Inicio:</strong></td>
                                    <td><strong>Fin:</strong></td>
                                    <td><strong>Total de Días:</strong></td>
                                </tr>
                                @forelse ($sanciones as $sancion)
                                    <tr>
                                        <td>{{ $sancion->fecha_inicio }}</td>
                                        <td>{{ $sancion->fecha_fin }}</td>
                                        <td>{{ $sancion->total_dias }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-muted text-center">No hay inasistencias registradas.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Scripts al final del documento --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        .nav-tabs .nav-link {
            font-weight: bold;
            padding: 25px 40px;
            border: 1px solid transparent;
            border-top-left-radius: 0.25rem;
            border-top-right-radius: 0.25rem;
            margin-bottom:20px
        }
        .nav-tabs .nav-link.active {
            color: #495057;
            background-color: #fff;
            border-color: #dee2e6 #dee2e6 #fff;
        }
        .nav-tabs .nav-link:not(.active):hover {
            border-color: #e9ecef #e9ecef #dee2e6;
        }
        .table-responsive {
            overflow-x: auto;
            max-width: 100%;
            margin-bottom: 1rem;
            border: 1px solid #dee2e6;
            padding: 10px;
            background-color: #fff;
            border-radius: 5px;
        }
        table {
            width: 100%;
            table-layout: fixed;
            border-collapse: collapse;
            background-color: #fff;
        }
        th, td {
            padding: 10px;
            text-align: center;
            vertical-align: middle;
            font-size: 14px;
            border: 1px solid #dee2e6;
            white-space: normal;
            word-wrap: break-word;
        }
        .table-success th,
        .table-success td {
            background-color: #d4edda;
        }
        .table-warning th,
        .table-warning td {
            background-color: #fff3cd;
        }
        .table-danger th,
        .table-danger td {
            background-color: #f8d7da;
            color: #721c24;
        }
        .table-secondary th,
        .table-secondary td {
            background-color: #e2e3e5;
        }
        .table-info th,
        .table-info td {
            background-color: #d1ecf1;
        }
    </style>

    <x-footer />
</x-app-layout>