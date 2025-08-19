<x-app-layout>
    <x-appbar />

    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css_dascboard.css') }}">

    <div class="contenedor-principal">
        <x-sidebar />

        <div class="container mt-4" style="height: 20%">
            <h2 class="titulo_formulario">Cargue Masivo de Empleados</h2>
    
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
    
            <form action="{{ route('empleados.importar') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="archivo" class="form-label">Archivo Excel:</label>
                    <input type="file" name="archivo" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success">📥 Importar Empleados</button>
            </form>
      
                    <br>
                    <button class="btn btn-warning btn-sm" onclick="window.location='{{ route('empleados.create') }}'" style="margin-bottom: 5px !important;">
                        <i class="fas fa-edit"></i>➕ Crear Nuevo Empleado
                    </button><br>
                    <button class="btn btn-warning btn-sm" onclick="window.location='{{ route('dashboard') }}'" style="margin-bottom: 5px !important; background:#ab4d1a;">
                        <i class="fas fa-edit"></i>🏠 Ir a Inicio
                    </button><br>
                </div>
            </div>
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



