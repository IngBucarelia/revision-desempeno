<x-app-layout>
    <x-appbar />

    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css_dascboard.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <div class="contenedor-principal">
        <x-sidebar />
        <div class="container mt-4">
            <div class="card shadow-lg border-0">
                <div class="card-body">
                    <h2 class="titulo_formulario">
                        <i class="bi bi-people-fill text-success"></i> Empleados Agrupados por Rol
                    </h2>

                    <div class="row mt-4">
                        <!-- Pestañas verticales -->
                        <div class="col-md-3">
                            <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                @foreach ($empleadosPorRol as $rol => $empleados)
                                    <button class="nav-link text-start mb-2 {{ $loop->first ? 'active' : '' }}" 
                                            id="v-pills-{{ Str::slug($rol) }}-tab" 
                                            data-bs-toggle="pill" 
                                            data-bs-target="#v-pills-{{ Str::slug($rol) }}" 
                                            type="button" 
                                            role="tab" 
                                            aria-controls="v-pills-{{ Str::slug($rol) }}" 
                                            aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                        <span class="badge bg-success rounded-pill me-2">{{ count($empleados) }}</span>
                                        {{ strtoupper($rol) }}
                                    </button>
                                @endforeach
                            </div>
                        </div>

                        <!-- Contenido de las pestañas -->
                        <div class="col-md-9">
                            <div class="tab-content" id="v-pills-tabContent">
                                @foreach ($empleadosPorRol as $rol => $empleados)
                                    <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" 
                                         id="v-pills-{{ Str::slug($rol) }}" 
                                         role="tabpanel" 
                                         aria-labelledby="v-pills-{{ Str::slug($rol) }}-tab">
                                        <div class="card border-0 shadow-sm">
                                            <div class="card-body p-0">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered tabla-empleados align-middle text-sm">
                                                        <thead class="table-success text-center">
                                                            <tr>
                                                                <th style="width: 10%;">ID</th>
                                                                <th style="width: 10%;">Cédula</th>
                                                                <th style="width: 20%;">Nombre</th>
                                                                <th style="width: 20%;">Cargo</th>
                                                                <th style="width: 20%;">Correo</th>
                                                                <th style="width: 15%;">Teléfono</th>
                                                                <th style="width: 15%;">Fecha Ingreso</th>
                                                                <th style="width: 15%;">Contrato</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($empleados as $empleado)
                                                                <tr>
                                                                    <td class="text-center">{{ $empleado->id }}</td>
                                                                    <td class="text-center">{{ $empleado->codigo }}</td>
                                                                    <td>{{ $empleado->nombre }}</td>
                                                                    <td>{{ $empleado->labor }}</td>
                                                                    <td>{{ $empleado->correo }}</td>
                                                                    <td class="text-center">{{ $empleado->telefono }}</td>
                                                                    <td class="text-center">{{ \Carbon\Carbon::parse($empleado->fecha_ingreso)->format('d/m/Y') }}</td>
                                                                    <td class="text-center">{{ $empleado->numero_contrato }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        .tabla-empleados td, .tabla-empleados th {
            white-space: normal;
            word-wrap: break-word;
            vertical-align: middle;
        }

        .tabla-empleados th {
            background-color: #e9fbe9;
            font-weight: 600;
        }

        .nav-pills .nav-link {
            border-radius: 0.25rem;
            padding: 0.75rem 1rem;
            margin-bottom: 0.5rem;
            background-color: #f8f9fa;
            color: #212529;
            font-weight: 500;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
        }

        .nav-pills .nav-link.active {
            background-color: #198754;
            color: white;
        }

        .nav-pills .nav-link:hover:not(.active) {
            background-color: #e9ecef;
        }

        .nav-pills .badge {
            min-width: 30px;
            display: inline-flex;
            justify-content: center;
        }

        .tab-content {
            padding: 0;
        }

        .card {
            border-radius: 0.5rem;
        }

        .titulo_formulario {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
        }
    </style>

    <x-footer />
</x-app-layout>