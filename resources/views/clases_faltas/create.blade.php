<x-app-layout>
    <x-appbar />

    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css_dascboard.css') }}">

    <div class="contenedor-principal">
        <x-sidebar />

         <div class="container py-4">
        <h2>Crear Nueva Clase de Falta</h2>
        <form method="POST" action="{{ route('clases_faltas.store') }}">
            @csrf
            <div class="mb-3">
                <label>Nombre</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>
            <button class="btn btn-success">Guardar</button>
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Volver</a>
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



