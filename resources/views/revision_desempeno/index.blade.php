<x-app-layout>
    <x-appbar />




<link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css_dascboard.css') }}">

    <div class="contenedor-principal">
        <x-sidebar />

        <div class="container mt-4 d-flex flex-column align-items-center" style="margin-bottom: 300px">
            <div class="contenido">    
                <h2 class="titulo_formulario">Listado de Revisiones de Desempeño</h2>
<a href="{{ route('revision_desempeno.create') }}" class="btn btn-success mb-3"> 📝  Crear Nueva</a>
<div id="paginationLinks">
    {{ $registros->links() }}
</div>
 <input type="text" id="searchInput" class="form-control mb-3" placeholder="Buscar movimiento...">

                <table class="table table-hover table-striped text-center mx-auto">
                    <thead>
                        <tr>
                            <th>Cedula</th>
                            <th>Trabajador</th>
                            <th>Fecha Solicitud</th>
                            <th>Elaborado Por:</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="tablaRegistros">
                        @foreach($registros as $registro)
                        <tr>
                            <td>{{ $registro->cedula }}</td>
                            <td>{{ $registro->nombre_trabajador }}</td>
                            <td>{{ $registro->fecha_solicitud }}</td>
                            <td>{{ $registro->elaborado?->nombre ?? 'Sin asignar' }}</td>
                            <td>{{ $registro->estado }}</td>
                            <td> <a href="{{ route('revision_desempeno.detalle', $registro->id) }}" class="btn btn-primary btn-sm">  👁️ Ver Detalle</a>
                                <br><br> @if(auth()->user()->role_id == 1 )
                                <a href="{{ route('revision_desempeno.edit', $registro->id) }}" class="btn btn-primary">✏️ Editar</a>
                                
                                <br><br><form action="{{ route('revision_desempeno.destroy', $registro->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" onclick="return confirm('¿Seguro que deseas eliminar este registro?')">🗑️ Eliminar</button>
                                </form>
                                @endif

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

{{ $registros->links() }}
                       
        


            <!-- Modal de Registro Exitoso -->
            <div class="modal fade" id="registroExitoso" tabindex="-1" aria-labelledby="registroExitosoLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="registroExitosoLabel">Registro Exitoso</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                        </div>
                        <div class="modal-body">
                            ¡Tu registro se ha completado con éxito!
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Aceptar</button>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    @if (session('registro_exitoso'))
                        var modal = new bootstrap.Modal(document.getElementById('registroExitoso'));
                        modal.show();
                    @endif
                });
            </script>

           <script>
    document.addEventListener("DOMContentLoaded", function () {
        function fetch_data(page, query = '') {
            fetch(`?page=${page}&search=${query}`)
                .then(response => response.text())
                .then(data => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(data, "text/html");

                    // Actualiza la tabla y la paginación con el nuevo contenido
                    document.getElementById("tablaRegistros").innerHTML = doc.querySelector("#tablaRegistros").innerHTML;
                    document.getElementById("paginationLinks").innerHTML = doc.querySelector("#paginationLinks").innerHTML;
                });
        }

        // Detecta clics en enlaces de paginación
        document.addEventListener("click", function (e) {
            if (e.target.closest(".pagination a")) {
                e.preventDefault();
                const page = e.target.getAttribute("href").split("page=")[1];
                const query = document.getElementById("searchInput").value;
                fetch_data(page, query);
            }
        });

        // Búsqueda en tiempo real
        document.getElementById("searchInput").addEventListener("keyup", function () {
            const query = this.value;
            fetch_data(1, query);
        });
    });
</script>



            <style>
                .grid-container {
                    display: grid;
                    grid-template-columns: repeat(3, 1fr);
                    gap: 10px;
                }
                .grid-item {
                    display: flex;
                    flex-direction: column;
                }
                .textarea-estilizado {
            width: 100%; /* Ocupa todo el ancho disponible */
            max-width: 600px; /* Ancho máximo */
            height: 150px; /* Aumenta la altura */
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            resize: vertical; /* Permite redimensionar solo en vertical */
            font-size: 14px;
            font-family: Arial, sans-serif;
        }

        /* Opcional: Estilo cuando el usuario hace clic */
        .textarea-estilizado:focus {
            border-color: #007bff; /* Color azul al hacer clic */
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

            </style>
        </div>
        <br><br>

            <button class="btn btn-warning btn-sm" onclick="window.location='{{ route('dashboard') }}'" style="margin-bottom: 5px !important; background:#ab4d1a;">
                <i class="fas fa-edit"></i>🏠 Ir a Inicio
            </button><br>
        </div>
        <script>
            document.querySelector('input[name="numero_documento_trabajador"]').addEventListener('change', function () {
                const documento = this.value;
            
                fetch(`/buscar-empleado/${documento}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'found') {
                            document.querySelector('input[name="codigo"]').value = data.empleado.numero_contrato;
                            document.querySelector('input[name="numero_documento_trabajador"]').value = data.empleado.codigo;
                            document.querySelector('input[name="nombre_trabajador"]').value = data.empleado.nombre;
                            document.querySelector('input[name="labor"]').value = data.empleado.labor ?? ''; // si no hay, queda vacío
                        } else {
                            alert('El usuario no existe. Por favor crear empleado para continuar .');
                            window.location.href = '/empleados/create'; // ajusta a tu ruta real
                        }
                    });
            });
            </script>
            @if (session('errores'))
            <div class="alert alert-warning">
                <strong>Errores durante la importación:</strong>
                <ul>
                    @foreach (session('errores') as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @if (session('log_file'))
                    <a href="{{ url('descargar-log/' . session('log_file')) }}" class="btn btn-sm btn-outline-primary mt-2">
                        Descargar registro de errores
                    </a>
                @endif
            </div>
        @endif
        
            
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

<x-footer />

</x-app-layout>
