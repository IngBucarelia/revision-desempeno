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
            <a href="{{ route('tipo_faltas.index') }}" class="btn btn-secondary">Volver</a>
        </form>
    </div>
    </div>

    <!-- Script para búsqueda y paginación AJAX -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            function fetch_data(page, query = '') {
                fetch(`?page=${page}&search=${query}`)
                    .then(response => response.text())
                    .then(data => {
                        let parser = new DOMParser();
                        let doc = parser.parseFromString(data, 'text/html');
                        let newRows = doc.querySelector("#tablaEmpleados").innerHTML;
                        let newPagination = doc.querySelector("#paginationLinks").innerHTML;
                        document.getElementById("tablaEmpleados").innerHTML = newRows;
                        document.getElementById("paginationLinks").innerHTML = newPagination;
                    });
            }

            // Manejar cambio de página
            document.addEventListener("click", function (e) {
                if (e.target.closest(".pagination a")) {
                    e.preventDefault();
                    let page = e.target.getAttribute("href").split("page=")[1];
                    let query = document.getElementById("searchInput").value;
                    fetch_data(page, query);
                }
            });

            // Buscador predictivo
            document.getElementById("searchInput").addEventListener("keyup", function () {
                let query = this.value;
                fetch_data(1, query);
            });
        });
    </script>

    <x-footer />
</x-app-layout>



