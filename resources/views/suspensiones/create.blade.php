<x-app-layout>
    <x-appbar />

    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css_dascboard.css') }}">

    <div class="contenedor-principal">
        <x-sidebar />
       
        <div class="contenido">    
            <div class="container">
                <h3 class="titulo_formulario">Registrar Nueva Suspension</h3>
                @if ($errors->any())
    <div class="alert alert-danger">
        <ul>

            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            
                <form action="{{ route('suspensiones.store') }}" method="POST">
                    @csrf
            
                     <div class="mb-3">
                        <label for="cedula">Empleado (Cédula)</label>
                        <select name="cedula" id="select-empleado" class="form-control" required>
                            <option value="">Seleccione</option>
                            @foreach($empleados as $empleado)
                                <option value="{{ $empleado->codigo }}">{{ $empleado->nombre }} - {{ $empleado->codigo }}</option>
                            @endforeach
                        </select>
                    </div>
<script>
    $(document).ready(function() {
        $('#select-empleado').select2({
            placeholder: "Seleccione un empleado...",
            allowClear: true,
            width: '100%'  // Asegura que se ajuste al form-control
        });
    });
</script>

                    <div class="mb-3">
                        <label for="codigo_falta">Registro Falta Disciplinaria</label><br>
                        <select name="codigo_falta" id="codigo_falta" class="form-control" required>
                            <option value="">Seleccione una falta disciplinaria</option>
                            <!-- Las opciones se llenarán con JavaScript -->
                        </select>
                    </div>
            
                    <div class="mb-3">
                        <label for="fecha_preaviso">Fecha de registro</label>
                        <input 
                            type="date" 
                            name="fecha_registro" 
                            class="form-control" 
                            value="{{ now()->toDateString() }}">
                        
                    </div>
            
                    <div class="mb-3">
                        <label for="fecha_inicio">Fecha Inicio</label>
                        <input 
                            type="date" 
                            name="fecha_inicio" 
                            id="fecha_inicio" 
                            class="form-control" 
                            required
                            onchange="calcularDias()" 
                        >
                    </div>
                    
                    <div class="mb-3">
                        <label for="fecha_fin">Fecha Fin</label>
                        <input 
                            type="date" 
                            name="fecha_fin" 
                            id="fecha_fin" 
                            class="form-control" 
                            required
                            onchange="calcularDias()"
                        >
                    </div>
                    
                    <div class="mb-3">
                        <label for="total_dias">Total de Días</label>
                        <input 
                            name="total_dias" 
                            id="total_dias" 
                            class="form-control" 
                            readonly 
                        >
                    </div>
            
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a href="{{ route('prorrogas.index') }}" class="btn btn-secondary">Volver</a>
                </form>
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
                    fetch(`/buscar-faltas-disciplinarias/suspenciones/${cedula}`)
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
