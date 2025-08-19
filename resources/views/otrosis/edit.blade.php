<x-app-layout>
    <x-appbar />

    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css_dascboard.css') }}">

    <div class="contenedor-principal">
        <x-sidebar />
        <div class="contenido container mt-4">
            <h3 class="mb-4">✍ Editar Otrosí para: <strong>{{ $otrosi->empleado->nombre }}</strong></h3>

            <form action="{{ route('otrosis.update', $otrosi->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="fecha_renovacion" class="form-label">📅 Fecha de Renovación</label>
                    <input type="date" name="fecha_renovacion" id="fecha_renovacion" class="form-control" value="{{ $otrosi->fecha_renovacion }}" required>
                </div>

                <div class="mb-3">
                    <label for="periodo" class="form-label">📄 Periodo</label>
                    <input type="text" name="periodo" id="periodo" class="form-control" value="{{ $otrosi->periodo }}" required>
                </div>

                <div class="mb-3">
                    <label for="numero_prorrogas" class="form-label">🔁 Número de Prórrogas</label>
                    <input type="number" name="numero_prorrogas" id="numero_prorrogas" class="form-control" value="{{ $otrosi->numero_prorrogas }}" required min="1">
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('otrosis.index') }}" class="btn btn-secondary">← Cancelar</a>
                    <button type="submit" class="btn btn-success">💾 Actualizar</button>
                </div>
            </form>
        </div>
    </div>

    <x-footer />
 <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- jQuery (requerido) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</x-app-layout>

