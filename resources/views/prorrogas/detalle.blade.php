<x-app-layout>
    <x-appbar />

    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css_dascboard.css') }}">

    <div class="contenedor-principal">
        <x-sidebar />

        <div class="contenido">    
            <div class="container">
                <h4 class="mb-3 text-success">Historial de Prórrogas</h4>
            
                @if($empleado)
                    <div class="card mb-4">
                        <div class="card-body">
                            <strong>Nombre:</strong> {{ $empleado->nombre }}<br>
                            <strong>Documento:</strong> {{ $empleado->codigo }}<br>
                            <strong>Cargo:</strong> {{ $empleado->labor }}
                        </div>
                    </div>
                @endif
            
                @if($prorrogas->count())
                    <table class="table table-bordered table-striped">
                        <thead class="bg-success text-white">
                            <tr>
                                <th>Preaviso</th>
                                <th>Fecha Preaviso</th>
                                <th>Inicio Prórroga</th>
                                <th>Vence Prórroga</th>
                                <th>Causa Terminación</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($prorrogas as $prorroga)
                                <tr>
                                    <td>{{ $prorroga->preaviso }}</td>
                                    <td>{{ $prorroga->fecha_preaviso }}</td>
                                    <td>{{ $prorroga->inicio_prorroga }}</td>
                                    <td>{{ $prorroga->vence_prorroga }}</td>
                                    <td>{{ $prorroga->causa_terminacion_contrato }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-warning">No se encontraron prórrogas para este empleado.</div>
                @endif
            
                <a href="{{ url()->previous() }}" class="btn btn-warning">Volver</a>
            </div>
        </div>
    </div>

    <x-footer />
</x-app-layout>
