<x-app-layout>
    <x-appbar />

    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css_dascboard.css') }}">

    <div class="contenedor-principal">
        <x-sidebar />

        <div class="container mt-4 d-flex flex-column align-items-center" style="margin-bottom: 300px">
            <div class="contenido">
                <h2 class="titulo_formulario">Historial de Movimientos de Novedades de Contrato</h2><br>

                <!-- Buscador en tiempo real -->
                <input type="text" id="searchInput" class="form-control mb-3" placeholder="Buscar movimiento...">

                <table class="table table-hover table-striped text-center mx-auto">
                    <thead>
                        <tr>
                            
                            <th>Código</th>
                            <th>Usuario</th>
                            <th>Acción</th>
                            <th>Fecha y Hora</th>
                        </tr>
                    </thead>
                    <tbody id="tablaMovimientos">
                        @foreach($movimientos as $mov)
                            <tr>
                            
                                <td>{{ $mov->codigo_llamado }}</td>
                                <td>{{ $mov->usuario->name ?? '—' }}</td>
                                <td>{{ $mov->accion }}</td>
                                <td>{{ $mov->fecha_hora }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div id="paginationLinks">
                    {{ $movimientos->links() }}
                </div>

                <a href="{{ route('dashboard') }}" class="btn btn-secondary mt-3">🏠 Volver al Inicio</a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            function fetch_data(page, query = '') {
                fetch(`?page=${page}&search=${query}`)
                    .then(response => response.text())
                    .then(data => {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(data, "text/html");
                        document.getElementById("tablaMovimientos").innerHTML = doc.querySelector("#tablaMovimientos").innerHTML;
                        document.getElementById("paginationLinks").innerHTML = doc.querySelector("#paginationLinks").innerHTML;
                    });
            }

            document.addEventListener("click", function (e) {
                if (e.target.closest(".pagination a")) {
                    e.preventDefault();
                    const page = e.target.getAttribute("href").split("page=")[1];
                    const query = document.getElementById("searchInput").value;
                    fetch_data(page, query);
                }
            });

            document.getElementById("searchInput").addEventListener("keyup", function () {
                const query = this.value;
                fetch_data(1, query);
            });
        });
    </script>

   
    <x-footer />
</x-app-layout>
