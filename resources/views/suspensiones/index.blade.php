<x-app-layout>
    <x-appbar />

    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css_dascboard.css') }}">

    <div class="contenedor-principal">
        <x-sidebar />

        <div class="container mt-4 d-flex flex-column align-items-center" style="margin-bottom: 300px">
            <div class="contenido">
                <h2 class="titulo_formulario">Listado de Suspensiones</h2><br>

                <!-- Buscador en tiempo real -->
                <input type="text" id="searchInput" class="form-control mb-3" placeholder="Buscar por cédula, código o fecha...">

                <table class="table table-hover table-striped text-center mx-auto">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Cédula</th>
                            <th>Código Falta</th>
                            <th>Fecha inicio</th>
                            <th>Fecha fin</th>
                            <th>Total Dias</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="tablaSuspensiones">
                        @foreach($suspensiones as $suspension)
                            <tr>
                                <td>{{ $suspension->id }}</td>
                                <td>{{ $suspension->cedula }}</td>
                                <td>{{ $suspension->codigo_falta }}</td>
                                <td>{{ $suspension->fecha_inicio }}</td>
                                <td>{{ $suspension->fecha_fin }}</td>
                                <td>{{ $suspension->total_dias }}</td>
                                <td>
                                    <form action="{{ route('suspensiones.destroy', $suspension->id) }}" method="POST" class="d-inline" onsubmit="return confirmarEliminacion()">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">🗑️ Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Links de paginación -->
                <div id="paginationLinks">
                    {{ $suspensiones->links() }}
                </div>

                <br>
                <a href="{{ route('suspensiones.create') }}" class="btn btn-success">📝 Registrar Nueva Suspensión</a><br>
                <a href="{{ route('dashboard') }}" class="btn btn-secondary">🏠 Ir a Inicio</a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            function fetch_data(page, query = '') {
                fetch(`?page=${page}&search=${query}`)
                    .then(response => response.text())
                    .then(data => {
                        let parser = new DOMParser();
                        let doc = parser.parseFromString(data, 'text/html');
                        let newRows = doc.querySelector("#tablaSuspensiones").innerHTML;
                        let newPagination = doc.querySelector("#paginationLinks").innerHTML;
                        document.getElementById("tablaSuspensiones").innerHTML = newRows;
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

            // Buscador en tiempo real
            document.getElementById("searchInput").addEventListener("keyup", function () {
                let query = this.value;
                fetch_data(1, query);
            });
        });

        function confirmarEliminacion() {
            return confirm("¿Estás seguro de que deseas eliminar esta suspensión?");
        }
    </script>

    <x-footer />
</x-app-layout>