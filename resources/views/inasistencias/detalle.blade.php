<x-app-layout>
    <x-appbar />

    <div class="contenedor-principal">
        <x-sidebar />

        <div class="container mt-4">
            <h2 class="titulo_formulario">Detalle de Inasistencias para la cédula: {{ $cedula }}</h2>
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Fecha Registro</th>
                        <th>Código Falta</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th>Total Días</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($inasistencias as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->fecha_registro }}</td>
                            <td>{{ $item->codigo_falta }}</td>
                            <td>{{ $item->fecha_inicio }}</td>
                            <td>{{ $item->fecha_fin }}</td>
                            <td>{{ $item->total_dias }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">No se encontraron inasistencias.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <a href="{{ route('dashboard') }}" class="btn btn-secondary">Volver al inicio</a>
        </div>
    </div>

    <x-footer />
</x-app-layout>
