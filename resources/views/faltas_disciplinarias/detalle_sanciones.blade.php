<x-app-layout>
    <x-appbar />




<link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css_dascboard.css') }}">

    <div class="contenedor-principal">
        <x-sidebar />

        <div class="container mt-5">
        <h3 class="text-center mb-4 text-danger">🚨 Sanciones del Trabajador</h3>

        <div class="mb-3">
            <strong>Cédula del Trabajador:</strong> {{ $cedula }}
        </div>

        @if($faltas->isEmpty())
            <div class="alert alert-info text-center">
                No se encontraron faltas con sanción activa para este trabajador.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-center align-middle" style="">
                    <thead class="table-danger text-white">
                        <tr>
                            <th style="width: 40px;">#</th>
                            <th style="width: 120px;">Fecha Reporte</th>
                            <th style="width: 120px;">Fecha Falta</th>
                            <th style="width: 150px;">Clase Falta</th>
                            <th style="width: 150px;">Tipo Falta</th>
                            <th style="width: 250px;">Descripción</th>
                            <th style="width: 200px;">Evidencias</th>
                            <th style="width: 100px;">Adjunto</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($faltas as $index => $falta)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $falta->fecha_reporte }}</td>
                                <td>{{ $falta->fecha_falta }}</td>
                                <td>{{ $falta->clase_falta }}</td>
                                <td>{{ $falta->tipo_falta }}</td>
                                <td style="word-wrap: break-word; white-space: normal;">{{ $falta->descripcion_falta }}</td>
                                <td style="word-wrap: break-word; white-space: normal;">{{ $falta->evidencias_adicionales ?? 'N/A' }}</td>
                                <td>
                                    @if ($falta->pdf_evidencia)
                                        <a href="{{ asset('storage/' . $falta->pdf_evidencia) }}" target="_blank">📄 Ver</a>
                                    @else
                                        <span class="text-muted">No disponible</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">⬅ Volver</a>
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

<x-footer />

</x-app-layout>
