<x-app-layout>
    <x-appbar />

    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css_dascboard.css') }}">

    <div class="contenedor-principal">
        <x-sidebar />

        <div class="contenido">    
            <div class="container">
                <h3 class="titulo_formulario">Registrar Nueva Prórroga</h3>
            
                <form action="{{ route('prorrogas.store') }}" method="POST">
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
                        <label for="preaviso">¿Hubo Preaviso?</label>
                        <select name="preaviso" class="form-control">
                            <option value="0">No</option>
                            <option value="1">Sí</option>
                        </select>
                    </div>
            
                    <div class="mb-3">
                        <label for="fecha_preaviso">Fecha de Preaviso</label>
                        <input type="date" name="fecha_preaviso" class="form-control">
                    </div>
            
                    <div class="mb-3">
                        <label for="inicio_prorroga">Inicio Prórroga</label>
                        <input type="date" name="inicio_prorroga" class="form-control" required>
                    </div>
            
                    <div class="mb-3">
                        <label for="vence_prorroga">Vence Prórroga</label>
                        <input type="date" name="vence_prorroga" class="form-control" required>
                    </div>
            
                    <div class="mb-3">
                        <label for="causa_terminacion_contrato">Causa Terminación Contrato</label>
                        <textarea name="causa_terminacion_contrato" class="form-control"></textarea>
                    </div>
            
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a href="{{ route('prorrogas.index') }}" class="btn btn-secondary">Volver</a>
                </form>
            </div>
        </div>
    </div>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- jQuery (requerido) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <x-footer />
</x-app-layout>
