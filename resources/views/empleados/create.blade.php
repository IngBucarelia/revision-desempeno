<x-app-layout>
    <x-appbar />


   

<link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css_dascboard.css') }}">

    <div class="contenedor-principal">
        <x-sidebar />

        <div class="contenido">    
            <div class="container">
            <h2 class="titulo_formulario">Registrar Nuevo Empleado</h2>
             @if ($errors->any())
            <div class="alert alert-danger">
                <strong>¡Ups!</strong> Hubo algunos problemas con los datos ingresados.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
 
            <form action="{{ route('empleados.store') }}" method="POST">
                @csrf
                <table class="table table-hover table-striped text-center mx-auto">
                    <tr>
                        <td colspan="5" style="text-align: center; background-color: rgba(94, 128, 80, 0.416);">
                            Información Básica del Empleado
                        </td>
                    </tr>
            
                    <tr>
                        <td colspan="2"><label for="codigo">Documento</label></td>
                        <td colspan="3"><label for="nombre">Nombre del Empleado</label></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="number" class="form-control" name="codigo" required></td>
                        <td colspan="3"><input type="text" class="form-control" name="nombre" required></td><input type="hidden" class="form-control" name="estado" value="1">
                    </tr>
            
                    <tr>
                        <td colspan="2"><label for="correo">Correo</label></td>
                        <td colspan="2"><label for="telefono">Teléfono</label></td>
                        <td colspan="2"><label for="estado_civil">Estado Civil</label></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="email" class="form-control" name="correo" required></td>
                        <td colspan="2"><input type="text" class="form-control" name="telefono" required></td>
                        <td colspan="2">
                            <select class="form-control" name="estado_civil" required>
                                <option value="Soltero">Soltero</option>
                                <option value="Casado">Casado</option>
                                <option value="Divorciado">Divorciado</option>
                                <option value="Viudo">Viudo</option>
                            </select>
                        </td>
                    </tr>
            
                    <tr>
                        <td colspan="3"><label for="fecha_ingreso">Fecha de Ingreso</label></td>
                        <td colspan="2"><label for="estado_civil">Fecha de Terminacion</label></td>
                        
                    </tr>
                    <tr>
                        <td colspan="3"><input type="date" class="form-control" name="fecha_ingreso" required></td>
                        <td colspan="2"><input type="date" class="form-control" name="fecha_terminacion" required></td>
                    </tr>
            
                    <tr>
                        <td colspan="3"><label for="labor">Labor</label></td>
                        <td colspan="2"><label for="periodo_prueba">Período de Prueba</label></td>
                    </tr>
                    <tr>
                        <td colspan="3"><input type="text" class="form-control" name="labor" required></td>
                        <td colspan="2">
                            <select class="form-control" name="periodo_prueba" required>
                                <option value="1">Sí</option>
                                <option value="0">No</option>
                            </select>
                        </td>
                    </tr>
            
                    <tr>
                        <td colspan="3"><label for="numero_contrato">Número de Contrato</label></td>
                        <td colspan="2"><div class="mb-3">
                            <label class="form-label">Rol</label>
                            
                        </div></td>
                    </tr>
                    <tr>
                        <td colspan="3"><input type="text" class="form-control" name="numero_contrato" required></td>
                        <td colspan="2"><select class="form-control" name="rol" required>
                            <option value="">Seleccione un rol</option>
                            <option value="empleado">Empleado</option>
                            <option value="gh">Gestión Humana</option>
                            <option value="sst">SST</option>
                            <option value="jefe">Jefatura</option>
                            <option value="jefe_inmediato">Jefe inmediato</option>
                            <option value="gerente">Gerencia</option>
                            
                        </select>
                            </td>
                    </tr>
                    <tr>
                        <td colspan="5">Jefe Inmediaro</td>
                    </tr>
                     <tr>
                        <td colspan="5">
                            <select name="id_jefe" class="form-control" required>
                                    <option value="">Seleccione</option>
                                    @foreach($empleados as $empleado)
                                        <option value="{{ $empleado->id }}" >
                                            {{ $empleado->nombre }}
                                        </option>
                                    @endforeach
                                </select>                         
                            
                            </td>
                    </tr>
                </table>
            
                <button type="submit" class="btn btn-primary w-100">💾 Guardar</button><br><br>
            
                                <a href="{{ route('dashboard') }}" class="btn btn-secondary"> 🏠 Ir a Inicio</a>

            </form>
            
            
           
        

                

                
              
</div>
        </div>
</div>

<x-footer />

</x-app-layout>

