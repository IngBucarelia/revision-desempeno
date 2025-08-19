<x-app-layout>
    <x-appbar />




<link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css_dascboard.css') }}">

    <div class="contenedor-principal">
        <x-sidebar />

        <div class="container mt-4 d-flex flex-column align-items-center" style="margin-bottom: 300px">
            <div class="contenido">    
                <h2 class="titulo_formulario">Administrar Cesantias</h2><br> 
            
                <table class="table table-hover table-striped text-center mx-auto">
                    <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                    @foreach($cesantias as $cesantia)
                    <tr>
                        <td>{{ $cesantia->codigo }}</td>
                        <td>{{ $cesantia->nombre }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm" style="margin-bottom: 5px !important;"><a href="{{ route('cesantia.edit', $cesantia->id) }}">Editar</a>
                                </button><br>
                            <form action="{{ route('cesantia.destroy', $cesantia) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button  class="block p-2 hover:bg-red-700 text-center bg-red-600 rounded" style="margin-bottom: 5px !important; background:#ab4d1a; color: aliceblue" class="btn btn-warning btn-sm"type="submit">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </table><br><br><button><a href="{{ route('cesantia.create') }}">Crear Fondo de  Cesantias</a></button>
        </div><button class="btn btn-warning btn-sm" onclick="window.location='{{ route('dashboard') }}'" style="margin-bottom: 5px !important; background:#ab4d1a;">
            <i class="fas fa-edit"></i> Ir a Inicio 
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

