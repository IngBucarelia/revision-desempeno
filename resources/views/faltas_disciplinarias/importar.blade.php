<x-app-layout>
    <x-appbar />

    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css_dascboard.css') }}">

    <div class="contenedor-principal">
        <x-sidebar />

        <div class="container mt-4" style="height: 20%"> 
            <h2 class="titulo_formulario">Cargue Masivo de Faltas Disciplinarias</h2>
    
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
    
            <form action="{{ route('procesos.importar') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="archivo" class="form-label">Archivo Excel:</label>
                    <input type="file" name="archivo" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success">📥 Importar Procesos</button>
            </form>
        </div>
        
@if (session('warning'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {!! session('warning') !!}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

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
    </div>

    @if (session('errores'))
    <div class="alert alert-warning">
        <strong>Se detectaron errores durante la importación:</strong>
        <ul>
            @foreach (session('errores') as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <x-footer />
</x-app-layout>



