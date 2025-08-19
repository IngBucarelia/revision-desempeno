<x-app-layout>
    <x-appbar />




<link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css_dascboard.css') }}">

    <div class="contenedor-principal">
        <x-sidebar />

        <div class="container mt-4 d-flex flex-column align-items-center" >
            <div class="container">
                <h4 class="titulo_formulario">Revisiones de Desempeño asignadas a Gestión Humana</h4>
            
            
                <input type="text" id="searchInput" class="form-control mb-3" placeholder="Buscar revisión...">

                    <div id="tabla-revisiones">
                        <table class="table table-bordered">
                            <thead class="table-success">
                                <tr>
                                    <th>Código</th>
                                    <th>Cédula</th>
                                    <th>Nombre</th>
                                    <th>Fecha Solicitud</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($revisiones as $rev)
                                    <tr>
                                        <td>{{ $rev->id }}</td>
                                        <td>{{ $rev->cedula }}</td>
                                        <td>{{ $rev->nombre_trabajador }}</td>
                                        <td>{{ $rev->fecha_solicitud }}</td>
                                        <td>
                                            <a href="{{ route('revision_desempeno.edit.gh', $rev->id) }}" class="btn btn-primary btn-sm">👁️ Revisar</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="5">No hay revisiones asignadas.</td></tr>
                                @endforelse
                            </tbody>
                        </table>

                        <div id="paginationLinks">
                            {{ $revisiones->links() }}
                        </div>
                    </div>
                <br><br>

            <a class="btn btn-warning btn-sm" href="{{ route('dashboard') }}" style="margin-bottom: 5px !important; background:#ab4d1a;">
                <i class="fas fa-edit"></i>🏠 Ir a Inicio
            </a><br>
            
                {{ $revisiones->withQueryString()->links() }}
            </div>
        <br><br>

           <script>
                document.addEventListener("DOMContentLoaded", function () {
                    function fetch_data(page, query = '') {
                        fetch(`?page=${page}&search=${query}`)
                            .then(response => response.text())
                            .then(data => {
                                const parser = new DOMParser();
                                const doc = parser.parseFromString(data, "text/html");
                                document.getElementById("tabla-revisiones").innerHTML = doc.querySelector("#tabla-revisiones").innerHTML;
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

        </div>
       
         



        <style>
            
/* Contenedor principal */
.container {
    width: 80%;
    max-width: 800px;
    background: white;
    padding: 20px;
    margin: 20px auto;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

/* Título principal */
.titulo-principal {
    text-align: center;
    color: #333;
    font-size: 24px;
    margin-bottom: 20px;
}

/* Secciones */
.seccion {
    border: 2px solid #ddd;
    background: #fafafa;
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 8px;
}

/* Títulos de las secciones */
.titulo-seccion {
    background: #218838;
    color: white;
    padding: 10px;
    margin: -15px -15px 15px -15px;
    border-radius: 8px 8px 0 0;
    font-size: 18px;
}

/* Campos de entrada */
input, select {
    width: 100%;
    padding: 8px;
    margin-top: 5px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

/* Botón */
.boton-guardar {
    text-align: center;
}

button {
    background: #28a745;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

button:hover {
    background: #218838;
}
        </style>
</div>

</div>

<x-footer />

</x-app-layout>

