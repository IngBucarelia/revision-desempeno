<x-app-layout>
    <x-appbar />

    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css_dascboard.css') }}">

    <div class="contenedor-principal">
        <x-sidebar />

        <div class="contenido">    
            <div class="container">
                <h3 class="titulo_formulario">Listado de Prórrogas</h3>
                <a href="{{ route('prorrogas.create') }}" class="btn btn-success mb-3">📝 Nueva Prórroga</a>
            
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
            
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Cédula</th>
                            <th>Preaviso</th>
                            <th>Fecha Preaviso</th>
                            <th>Inicio</th>
                            <th>Vencimiento</th>
                            <th>Causa</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($prorrogas as $prorroga)
                            <tr>
                                <td>{{ $prorroga->codigo }}</td>
                                <td>{{ $prorroga->cedula }}</td>
                                <td>{{ $prorroga->preaviso ? 'Sí' : 'No' }}</td>
                                <td>{{ $prorroga->fecha_preaviso }}</td>
                                <td>{{ $prorroga->inicio_prorroga }}</td>
                                <td>{{ $prorroga->vence_prorroga }}</td>
                                <td>{{ $prorroga->causa_terminacion_contrato }}</td>
                                <td>
                                    <form action="{{ route('prorrogas.destroy', $prorroga->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar prórroga?')">🗑️ Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            
                {{ $prorrogas->links() }}
            </div>
        </div>
    </div>

    <x-footer />
</x-app-layout>
