<x-app-layout>
    <x-appbar />

    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css_dascboard.css') }}">

    <div class="contenedor-principal">
        <x-sidebar />

        <div class="contenido">    
            <div class="container">
                <h2>Editar Empleado</h2>
                <form action="{{ route('empleados.update', $empleado->id) }}" method="POST"  enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <table class="table table-hover table-striped text-center mx-auto">
                        <tr>
                            <td colspan="4" style="text-align: center; background-color: rgba(94, 128, 80, 0.416);">
                                Información Básica del Empleado
                            </td>
                        </tr>
                
                        <tr>
                            <td colspan="2"><label for="codigo">Documento</label></td>
                            <td colspan="2"><label for="nombre">Nombre del Empleado</label></td>
                        </tr>
                        <tr>
                            <td colspan="2"><input type="number" class="form-control" name="codigo"  value="{{ $empleado->codigo }}" required></td>
                            <td colspan="2"><input type="text" class="form-control" name="nombre"  value="{{ $empleado->nombre }}" required></td>
                        </tr>
                
                        <tr>
                            <td colspan="2"><label for="correo">Correo</label></td>
                            <td colspan="2"><label for="telefono">Teléfono</label></td>
                        </tr>
                        <tr>
                            <td colspan="2"><input type="email" class="form-control" name="correo"  value="{{ $empleado->correo }}" required></td>
                            <td colspan="2"><input type="text" class="form-control" name="telefono" value="{{ $empleado->telefono }}" required></td>
                        </tr>
                
                        <tr>
                            <td colspan="4"><label for="estado_civil">Estado Civil</label></td>
                           
                        </tr>
                        <tr>
                            <td colspan="4">
                                <select class="form-control" name="estado_civil" required>
                                    <option value="Soltero" {{ $empleado->estado_civil == 'Soltero' ? 'selected' : '' }}>Soltero</option>
                                    <option value="Casado" {{ $empleado->estado_civil == 'Casado' ? 'selected' : '' }}>Casado</option>
                                    <option value="Divorciado" {{ $empleado->estado_civil == 'Divorciado' ? 'selected' : '' }}>Divorciado</option>
                                    <option value="Viudo" {{ $empleado->estado_civil == 'Viudo' ? 'selected' : '' }}>Viudo</option>
                                </select>
                            </td>
                            
                        </tr>
                
                        <tr>
                            <td colspan="2"><label for="labor">Labor</label></td>
                            <td colspan="2"><label for="periodo_prueba">Período de Prueba</label></td>
                        </tr>
                        <tr>
                            <td colspan="2"><input type="text" class="form-control" value="{{ $empleado->labor }}" name="labor" required></td>
                            <td colspan="2">
                                <select class="form-control" name="periodo_prueba" required>
                                    <option value="si" {{ $empleado->periodo_prueba == 'si' ? 'selected' : '' }}>Sí</option>
                                    <option value="no" {{ $empleado->periodo_prueba == 'no' ? 'selected' : '' }}>No</option>
                                </select>
                            </td>
                        </tr>
                
                        <tr>
                            <td colspan="2"><label for="numero_contrato">Número de Contrato</label></td>
                            <td><div class="mb-3">
                                <label class="form-label">Rol</label>
                                
                            </div></td>
                        </tr>
                        <tr>
                            <td colspan="2"><input type="text" class="form-control" name="numero_contrato" value="{{ $empleado->numero_contrato }}" required></td>
                            <td><select class="form-control" name="rol" required>
                                <option value="">Seleccione un rol</option>
                                <option value="Empleado" {{ $empleado->rol == 'Empleado' ? 'selected' : '' }}>Empleado</option>
                                <option value="Gestión Humana" {{ $empleado->rol == 'Gestión Humana' ? 'selected' : '' }}>Gestión Humana</option>
                                <option value="SST" {{ $empleado->rol == 'SST' ? 'selected' : '' }}>SST</option>
                                <option value="Jefatura" {{ $empleado->rol == 'Jefatura' ? 'selected' : '' }}>Jefatura</option>
                                 <option value="jefe_inmediato" {{ $empleado->rol == 'jefe_inmediato' ? 'selected' : '' }}>Jefe inmediato</option>
                                <option value="Gerencia" {{ $empleado->rol == 'Gerencia' ? 'selected' : '' }}>Gerencia</option>
                            </select></td>
                        </tr>
                        <tr>
                            <td colspan="2"><label for="numero_contrato">Fecha Ingreso </label></td>
                            <td><div class="mb-3">
                                <label class="form-label">Fecha Fin Contrato</label>                                
                            </div></td>
                        </tr>
                        <tr>
                            <td colspan="2"><input type="date" class="form-control" value="{{ $empleado->fecha_ingreso }}" name="fecha_ingreso" required></td>
                            <td colspan="2"><input type="date" class="form-control" value="{{ $empleado->fecha_terminacion }}" name="fecha_terminacion" required></td>
                        </tr>
                        <tr>
                            <td colspan="4"><label for="id_jefe">Jefe Inmediato</label></td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <select class="form-control" name="id_jefe">
                                    <option value="">Seleccione un jefe inmediato</option>
                                    @foreach($jefe_inmediato as $jefe)
                                        @if($jefe->id !== $empleado->id) {{-- Evita que alguien se asigne a sí mismo --}}
                                            <option value="{{ $jefe->id }}" {{ $empleado->id_jefe == $jefe->id ? 'selected' : '' }}>
                                                {{ $jefe->nombre }} - {{ $jefe->codigo }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </td>
                        </tr>

                    </table> <button type="submit" class="btn btn-success">Guardar y Continuar</button>
                </form>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                
                
                <button class="btn btn-warning btn-sm" onclick="window.location='{{ url()->previous() }}'" style="margin-bottom: 5px !important; background:#ab4d1a;">
                    <i class="fas fa-edit"></i> Cancelar
                </button><br>
            
            </div>
        </div>
    </div>

    <x-footer />
</x-app-layout>
