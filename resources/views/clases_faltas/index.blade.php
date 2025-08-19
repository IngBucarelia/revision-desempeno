<x-app-layout>
    <x-appbar />

    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css_dascboard.css') }}">

    <div class="contenedor-principal">
        <x-sidebar />

        <div class="container py-4">
        <a href="{{ route('clases_faltas.create') }}" class="btn btn-success mb-3">+ Agregar Nueva Clase</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead class="table-success">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clases as $clase)
                    <tr>
                        <td>{{ $clase->id }}</td>
                        <td>{{ $clase->nombre }}</td>
                        <td>
                            <a href="{{ route('clases_faltas.edit', $clase->id) }}" class="btn btn-primary btn-sm">Editar</a>
                            <form action="{{ route('clases_faltas.destroy', $clase->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('¿Seguro de eliminar esta clase?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
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



