<x-app-layout>
    <x-appbar />

    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css_dascboard.css') }}">

    <div class="contenedor-principal">
        <x-sidebar />

        <div class="container mt-4 d-flex flex-column align-items-center" style="margin-bottom: 300px">
            <h2 class="titulo_formulario">Historial de Movimientos Faltas Disciplinarias</h2>

            <!-- Buscador -->
            <input type="text" id="search" placeholder="Buscar..." class="form-control mb-3">

            <!-- Tabla de Movimientos -->
            <div id="tabla-contenedor">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID Proceso</th>
                            <th>Código</th> 
                            <th>Usuario</th>
                            <th>Acción</th>
                            <th>Fecha y Hora</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($movimientos as $mov)
                        <tr>
                            <td>{{ $mov->proceso_id }}</td>
                            <td>{{ $mov->codigo_proceso }}</td>
                            <td>{{ $mov->usuario->name }}</td>
                            <td>{{ $mov->accion }}</td>
                            <td>{{ $mov->fecha_hora }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Paginación -->
                <div class="pagination-links">
                    {{ $movimientos->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Script para Buscador Predictivo y Paginación AJAX -->
    <script>
        $(document).ready(function () {
            function fetch_data(page, query = '') {
                $.ajax({
                    url: "?page=" + page + "&search=" + query,
                    success: function (data) {
                        $("#tabla-contenedor").html($(data).find("#tabla-contenedor").html());
                    }
                });
            }

            // Cambiar de página
            $(document).on("click", ".pagination a", function (e) {
                e.preventDefault();
                let page = $(this).attr("href").split("page=")[1];
                let query = $("#search").val();
                fetch_data(page, query);
            });

            // Búsqueda en tiempo real
            $("#search").on("keyup", function () {
                let query = $(this).val();
                fetch_data(1, query);
            });
        });
    </script>

    <x-footer />
</x-app-layout>
