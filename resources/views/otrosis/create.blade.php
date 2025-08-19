<x-app-layout>
    <x-appbar />

    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css_dascboard.css') }}">

    <div class="contenedor-principal">
        <x-sidebar />
       
        <div class="contenido">    
        <div class="container">
            <h3 class="mb-4">Crear Otrosí para: {{ $empleado->nombre }}</h3>

            <form action="{{ route('otrosis.store') }}" method="POST">
                @csrf
                <input type="hidden" name="empleado_id" value="{{ $empleado->id }}">
                <div class="mb-3">
                    <label> 📄Numero de Documento:</label>
                    <input type="number" name="codigo_trabajador" value="{{ $empleado->codigo }}" class="form-control" readonly required>
                </div>
                <div class="mb-3">
                    <label> 📄Periodo de renovación:</label>
                    <input type="text" name="periodo" class="form-control" placeholder="Ej: Tres (03) Meses" required>
                </div>

                <div class="mb-3">
                    <label>📅 Fecha de renovación:</label>
                    <input type="date" name="fecha_renovacion" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>🔁 Número de prórrogas:</label>
                    <input type="number" name="numero_prorrogas" class="form-control" value="1" required>
                </div>

                <button type="submit" class="btn btn-success" > 💾 Guardar Otrosí</button>
            </form>
        </div>

        </div>
    </div>

    <x-footer />
 <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- jQuery (requerido) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</x-app-layout>

