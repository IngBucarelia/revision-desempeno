<x-app-layout>
   
    <x-appbar />
    <div class="d-flex" style="background-image: url('../images/fondo.png'); ">
        <x-sidebar />

        <div class="container mt-4 d-flex flex-column align-items-center">
            <h2 class="titulo_formulario">Lista de Colaboradores</h2><br>

             {{-- Alerta de éxito --}}
        

            <div class="table-responsive w-100 d-flex justify-content-center">
                <table class="table table-hover table-striped text-center mx-auto" style="max-width: 800px;">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Rol</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($usuario as $usuario)
                            <tr>
                                <td>{{ $usuario->id }}</td>
                                <td>{{ optional($usuario->role)->nombre ?? 'Sin rol' }}</td>
                                <td>{{ $usuario->name }}</td>
                                <td>{{ $usuario->email }}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm" onclick="window.location='{{ route('usuarios.edit', $usuario->id) }}'" style="margin-bottom: 5px !important;">
                                        <i class="fas fa-edit"></i>✏️ Editar
                                    </button><br>
                                    
                                    <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro?')" style="margin-bottom: 5px !important; background:#ab4d1a;">
                                            <i class="fas fa-trash-alt"></i>🗑️ Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div><br><br>
            <button class="btn btn-warning btn-sm" onclick="window.location='{{ route('register') }}'" style="margin-bottom: 5px !important;">
                <i class="fas fa-edit"></i>📝 Crear Nuevo Colaborador
            </button><br>
            <button class="btn btn-warning btn-sm" onclick="window.location='{{ route('dashboard') }}'" style="margin-bottom: 5px !important; background:#ab4d1a;">
                <i class="fas fa-edit"></i>🏠 Ir a Inicio 
            </button><br>

        </div>
    </div>
    <x-footer />

</x-app-layout>
