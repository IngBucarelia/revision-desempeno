<x-app-layout>
    <x-appbar />

    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css_dascboard.css') }}">

    <div class="contenedor-principal">
        <x-sidebar />
       
        <div class="contenido">    
            <div class="container mt-4">
        <h3 class="text-success text-center">REGISTRO DE NOVEDAD DE CONTRATO</h3>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('novedades_contrato.store') }}">
            @csrf

            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Fecha de reporte:</label>
                <div class="col-sm-4">
                    <input readonly type="date"  value="{{$novedad->fecha_reporte}}" name="fecha_reporte" class="form-control" required>
                </div>
            </div>

           <div class="mb-4">
                <label class="form-label">Marque con una X el tipo de novedad</label>

                <div class="form-check form-check-inline">
                    <input readonly class="form-check-input" type="radio" name="tipo_novedad" value="D" required
                        {{ old('tipo_novedad', $novedad->tipo_novedad ?? '') == 'D' ? 'checked' : '' }}>
                    <label class="form-check-label">D = Desvinculación</label>
                </div>

                <div class="form-check form-check-inline">
                    <input readonly class="form-check-input" type="radio" name="tipo_novedad" value="R"
                        {{ old('tipo_novedad', $novedad->tipo_novedad ?? '') == 'R' ? 'checked' : '' }}>
                    <label class="form-check-label">R = Renovación</label>
                </div>

                <div class="form-check form-check-inline">
                    <input readonly class="form-check-input" type="radio" name="tipo_novedad" value="C"
                        {{ old('tipo_novedad', $novedad->tipo_novedad ?? '') == 'C' ? 'checked' : '' }}>
                    <label class="form-check-label">C = Cambio Modalidad de Contrato</label>
                </div>
            </div>

            <table class="table table-bordered">
                <thead class="table-success">
                    <tr>
                        <th>NOMBRE TRABAJADOR</th>
                        <th>CODIGO TRABAJADOR</th>
                        <th>FECHA DE NOVEDAD</th>
                        <th>TIEMPO DE LA PRORROGA</th>
                        <th>TIPO CONTRATO</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input readonly type="text" value="{{$novedad->nombre_trabajador}}" name="nombre_trabajador" class="form-control" required></td>
                        <td><input readonly type="text" value="{{$novedad->codigo_trabajador}}" name="codigo_trabajador" class="form-control" required></td>
                        <td><input readonly type="date" value="{{$novedad->fecha_novedad}}" name="fecha_novedad" class="form-control" required></td>
                        <td><input readonly type="text" value="{{$novedad->tiempo_prorroga}}" name="tiempo_prorroga" class="form-control"></td>
                        <td><input readonly type="text" value="{{$novedad->tipo_contrato}}" name="tipo_contrato" class="form-control" required></td>
                    </tr>
                </tbody>
            </table>

            <div class="mb-3">
                <label class="form-label">Observaciones:</label>
                <textarea readonly name="observaciones" class="form-control" rows="3">{{$novedad->observaciones}}</textarea>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <label>Diligenciado por:</label>
                    <input readonly type="text" value="{{$novedad->diligenciado_por}}" name="diligenciado_por" class="form-control">
                </div>
                <div class="col-md-6">
                    <label>Autorizado por:</label>
                    <input readonly type="text" value="{{$novedad->autorizado_por}}" name="autorizado_por" class="form-control">
                </div>
            </div>

            
    <a href="{{ route('novedades_contrato.imprimir', $novedad->id) }}" target="blank" style="background-color: cadetblue" class="btn btn-success mt-3">
                    <i class="fas fa-file-pdf"></i>🖨️ Imprimir PDF
                </a>
        </form><br>
        
    </div>
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
