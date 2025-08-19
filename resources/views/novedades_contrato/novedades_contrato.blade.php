<x-app-layout>
    <x-appbar />

    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css_dascboard.css') }}">

    <div class="contenedor-principal">
        <x-sidebar />
       
        <div class="contenido"  style="height: 20px">    
            <div class="container mt-4">
        <h3 class="titulo_formulario">📋 Novedades de Contrato</h3>
        <a href="{{ route('novedades.verificarCedula') }}" class="btn btn-success mb-3">+ Nueva Novedad</a>

        <table class="table table-bordered">
            <thead class="table-success">
                <tr>
                    <th>ID</th>
                    <th>Tipo</th>
                    <th>Empleado</th>
                    <th>Documento</th>
                    <th>Fecha Novedad</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($novedades as $novedad)
                    <tr>
                        <td>{{ $novedad->id }}</td>
                        <td>
                            @switch($novedad->tipo_novedad)
                                @case('D') Desvinculación @break
                                @case('R') Renovación @break
                                @case('C') Cambio Modalidad @break
                            @endswitch
                        </td>
                        <td>{{ $novedad->nombre_trabajador }}</td>
                        <td>{{ $novedad->codigo_trabajador }}</td>
                        <td>{{ $novedad->fecha_novedad }}</td>
                        <td>
                            <a href="{{ route('novedades_contrato.verDetalle', $novedad->id) }}" class="btn btn-success btn-sm"> 👁️ Ver</a>
                            <a href="{{ route('novedades_contrato.imprimir', $novedad->id) }}" class="btn btn-info btn-sm" target="_blank">📄 Imprimir</a>
                    </tr>
                @empty
                    <tr><td colspan="5">No hay registros.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div><br>
                 <button class="btn btn-warning btn-sm" onclick="window.location='{{ url()->previous() }}'" style="margin-bottom: 5px !important; background:#ab4d1a;">
                </i>❌ Cancelar
            </button><br>
        </div>
    </div>

    <x-footer />
    <script>
        function calcularDias() {
                const fechaInicio = document.getElementById('fecha_inicio').value;
                const fechaFin = document.getElementById('fecha_fin').value;
                
                if (fechaInicio && fechaFin) {
                    const inicio = new Date(fechaInicio);
                    const fin = new Date(fechaFin);
                    
                    // Si la fecha fin es menor, intercambia los valores
                    if (fin < inicio) {
                        alert("¡La fecha fin no puede ser anterior a la fecha inicio!");
                        document.getElementById('fecha_fin').value = fechaInicio; // Corrige automáticamente
                        fin = inicio; // Reasigna para el cálculo
                    }
                    
                    const diffDays = Math.ceil((fin - inicio) / (86400000)) + 1;
                    document.getElementById('total_dias').value = diffDays;
                }
            }
            
    </script>
    <script>
        $(document).ready(function () {
    $('#select-empleado').on('change', function () {
        const cedula = $(this).val();
        const selectFaltas = $('#codigo_falta');

        if (cedula) {
            fetch(`/buscar-faltas-disciplinarias/inasistencias/${cedula}`)
                .then(response => response.json())
                .then(data => {
                    selectFaltas.empty().append('<option value="">Seleccione una falta disciplinaria</option>');

                    data.forEach(falta => {
                        selectFaltas.append(
                            $('<option>', {
                                value: falta.id,
                                text: `Falta #${falta.id} - ${falta.descripcion_falta} - ${falta.fecha_reporte}`
                            })
                        );
                    });
                });
        } else {
            selectFaltas.empty().append('<option value="">Seleccione una falta disciplinaria</option>');
        }
    });
});

        </script>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- jQuery (requerido) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</x-app-layout>
