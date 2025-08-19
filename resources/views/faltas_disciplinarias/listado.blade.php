<x-app-layout>
    <x-appbar />




<link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css_dascboard.css') }}">

    <div class="contenedor-principal">
        <x-sidebar />

        <div class="container mt-4 d-flex flex-column align-items-center" style="margin-bottom: 300px">
            <div class="contenido">    
                <div class="container"> @foreach($procesos as $proceso)
                    <h2 class="titulo_formulario">Faltas Disciplinarias para el documento: <spam style="color: #333" >{{ $proceso->numero_documento_trabajador }}</spam></h2>
                @endforeach
                    @if($procesos->isEmpty())
                        <div class="alert alert-warning">No se encontraron procesos para este número de documento.</div>
                    @else
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    
                                    <th>Nombre</th>
                                    <th>Creación</th>
                                    <th>Proceso</th>
                                    <th> Falta</th>
                                    <th>Cantidad</th>
                                    <th>Trabajo</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($procesos as $proceso)
                                    <tr>
                                        
                                        <td>{{ $proceso->nombre_trabajador }}</td>
                                        <td>{{ $proceso->fecha_reporte }}</td>
                                        <td>{{ $proceso->fecha_falta }}</td>
                                        <td>{{ $proceso->clase_falta }}</td>
                                        <td>{{ $proceso->cantidad }}</td>
                                        <td>{{ $proceso->labor }}</td>
                                        <td>
                                            <a href="{{ route('faltas_disciplinarias.detalle', $proceso->id) }}" class="btn btn-info">👁️ Ver Detalle</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
                       
        


            

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

            <button class="btn btn-warning btn-sm" onclick="window.location='{{ route('faltas_disciplinarias.buscar') }}'" style="margin-bottom: 5px !important; background:#ab4d1a;">
                <i class="fas fa-edit"></i> Cancelar
            </button><br>
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

<x-footer />

</x-app-layout>

