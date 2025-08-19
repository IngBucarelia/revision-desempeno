@extends('layouts.app')
<x-appbar />


@section('content')

<div class="d-flex" style="background-image: url('../../../images/fondo.png'); ">
    <x-sidebar />

    <div class="container mt-4 d-flex flex-column align-items-center" >

        <div class="w-100 d-flex justify-content-center">
             {{-- Alerta de éxito --}}
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
            <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST" class="form-editar w-100">
                @csrf
                @method('PUT')
            
                <h3 class="titulo_formulario">Editar Usuario</h3><br>
                <span>Por favor ingrese la nueva información del usuario </span><br><br>
            
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label><br>
                    <input type="text" class="form-control input-custom" id="name" name="name" value="{{ $usuario->name }}" required>
                </div><br>
            
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label><br>
                    <input type="email" class="form-control input-custom" id="email" name="email" value="{{ $usuario->email }}" required>
                </div><br>
            
                <div class="mb-3">
                    <label for="role_id" class="form-label">Rol</label><br>
                    <select class="form-control input-custom" id="role_id" name="role_id" required>
                        @foreach($roles as $rol)
                            <option value="{{ $rol->id }}" {{ $usuario->role_id == $rol->id ? 'selected' : '' }}>
                                {{ $rol->nombre }} 
                            </option>
                        @endforeach
                    </select>
                </div><br>
            
                
                    <button type="submit" class="btn btn-warning btn-sm" style="margin-bottom: 10px">Actualizar</button><br>
                    <button class="btn btn-warning btn-sm" onclick="window.location='{{ route('usuarios.index', $usuario->id) }}'" style="margin-bottom: 5px !important; background:#ab4d1a;">
                        <i class="fas fa-edit"></i> Cancelar
                    </button><br>
                
                
            </form>
            
        </div>
    </div>
</div>

<x-footer />

@endsection
