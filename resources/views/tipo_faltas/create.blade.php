<x-app-layout>
    <x-appbar />

    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css_dascboard.css') }}">

    <div class="contenedor-principal">
        <x-sidebar />

        <div class="container mt-4">
        <h2>{{ isset($tipo_falta) ? 'Editar Tipo de Falta' : 'Nuevo Tipo de Falta' }}</h2>

        <form action="{{ isset($tipo_falta) ? route('tipo_faltas.update', $tipo_falta->id) : route('tipo_faltas.store') }}" method="POST">
            @csrf
            @if(isset($tipo_falta)) @method('PUT') @endif

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre del tipo de falta</label>
                <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $tipo_falta->nombre ?? '') }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Volver</a>
        </form>
    </div>
    </div>

    <!-- Script para búsqueda y paginación AJAX -->
    

    <x-footer />
</x-app-layout>



