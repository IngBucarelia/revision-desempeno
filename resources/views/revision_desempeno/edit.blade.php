<x-app-layout>
    <x-appbar />




<link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css_dascboard.css') }}">

    <div class="contenedor-principal">
        <x-sidebar />

        <div class="container mt-4 d-flex flex-column align-items-center" style="margin-bottom: 300px">
            <div class="contenido">    
                <h2>Editar Revisión de Desempeño</h2>
                <form method="POST" action="{{ route('revision_desempeno.update', $registro->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
            
                    <table class="table table-hover table-striped text-center mx-auto">
                        <tr>
                            <td colspan="6" style="text-align: center; background-color: rgba(94, 128, 80, 0.416);">
                                Información General del Empleado
                            </td>
                        </tr>
                        <tr>
                            <td><label>ID</label></td>
                            <td><input type="text"  name="id" value="{{ $registro->id }}" ></td>
                            <td><label>Fecha Solicitud</label></td>
                            <td><input type="date"  name="fecha_solicitud" value="{{ $registro->fecha_solicitud }}"></td>
                            <td><label>Cédula</label></td>
                            <td><input type="text"  name="cedula" value="{{ $registro->cedula }}"></td>
                        </tr>
                        <tr>
                            <td><label>Nombre del Trabajador</label></td>
                            <td><input type="text"  name="nombre_trabajador" value="{{ $registro->nombre_trabajador }}"></td>
                            <td><label>Cargo</label></td>
                            <td><input type="text"  name="cargo" value="{{ $registro->cargo }}"></td>
                            <td><label>Fecha Ingreso</label></td>
                            <td><input type="date"  name="fecha_ingreso" value="{{ $registro->fecha_ingreso }}"></td>
                        </tr>
                        <tr>
                            <td><label>Prorrogas</label></td>
                            <td><input type="text"  name="prorrogas" value="{{ $registro->prorrogas }}"></td>
                            <td><label>Fecha Vencimiento</label></td>
                            <td><input type="date"  name="fecha_vencimiento" value="{{ $registro->fecha_vencimiento }}"></td>
                            <td><label>Faltas Disciplinarias</label></td>
                            <td><input type="text"  name="faltas_disciplinarias" value="{{ $registro->faltas_disciplinarias }}"></td>
                        </tr>
                        <tr>
                            <td><label>Llamados Atención</label></td>
                            <td><input type="text"  name="llamados_atencion" value="{{ $registro->llamados_atencion }}"></td>
                            <td><label>Sanciones</label></td>
                            <td><input type="text"  name="sanciones" value="{{ $registro->sanciones }}"></td>
                            <td><label>Inasistencias</label></td>
                            <td><input type="text"  name="inasistencias" value="{{ $registro->inasistencias }}"></td>
                        </tr>
                        <tr>
                            <td colspan="6" style="text-align: center; background-color: rgba(94, 128, 80, 0.416);">
                                Gestión Humana
                            </td>
                        </tr>
                        <tr>
                            <td><label>Observaciones GH</label></td>
                            <td colspan="5"><textarea name="observaciones_gh" class="form-control">{{ $registro->observaciones_gh }}</textarea></td>
                        </tr>
                        <tr>
                            <td><label>GH Diligenciado Por</label></td>
                            <td><input type="text"  name="gh_diligenciado_por" value="{{ $registro->gh_diligenciado_por }}"></td>
                            <td><label>GH Firma</label></td>
                            <td><img src="{{ asset($registro->gh_firma) }}" class="img-thumbnail" style="max-width: 120px; max-height: 60px;"></td>
                            <td><label>GH Fecha</label></td>
                            <td><input type="date"  name="gh_fecha" value="{{ $registro->gh_fecha }}"></td>
                        </tr>
                        <tr>
                            <td colspan="6" style="text-align: center; background-color: rgba(94, 128, 80, 0.416);">
                                SST
                            </td>
                        </tr>
                        <tr>
                            <td><label>Cumplimiento SGSST</label></td>
                            <td><input type="text" name="cumplimiento_sgsst" value="{{ $registro->cumplimiento_sgsst }}"></td>
                            <td><label>Hábitos y Comportamientos</label></td>
                            <td><input type="text" name="habitos_comportamientos" value="{{ $registro->habitos_comportamientos }}"></td>
                            <td><label>SST Diligenciado Por</label></td>
                            <td><input type="text" name="sst_diligenciado_por" value="{{ $registro->sst_diligenciado_por }}"></td>
                        </tr>
                        <tr>
                            <td><label>SST Firma</label></td>
                            <td><img src="{{ asset($registro->sst_firma) }}" class="img-thumbnail" style="max-width: 120px; max-height: 60px;"></td>
                            <td><label>SST Fecha</label></td>
                            <td><input type="date" name="sst_fecha" value="{{ $registro->sst_fecha }}"></td>
                            <td><label>SST Cumple</label></td>
                            <td><input type="text" name="sst_cumple" value="{{ $registro->sst_cumple }}"></td>
                        </tr>
                        <tr>
                            <td colspan="6" style="text-align: center; background-color: rgba(94, 128, 80, 0.416);">
                                Jefatura
                            </td>
                        </tr>
                        <tr>
                            <td><label>Labor Actual</label></td>
                            <td><input type="text" name="labor_actual" value="{{ $registro->labor_actual }}"></td>
                            <td><label>Labores Desempeñadas</label></td>
                            <td><input type="text" name="labores_desempenadas" value="{{ $registro->labores_desempenadas }}"></td>
                            <td><label>Jefe Diligenciado Por</label></td>
                            <td><input type="text" name="jefe_diligenciado_por" value="{{ $registro->jefe_diligenciado_por }}"></td>
                        </tr>
                        <tr>
                            <td><label>Jefe Firma</label></td>
                            <td><img src="{{ asset($registro->jefe_firma) }}" class="img-thumbnail" style="max-width: 120px; max-height: 60px;"></td>
                            <td><label>Jefe Fecha</label></td>
                            <td><input type="date" name="jefe_fecha" value="{{ $registro->jefe_fecha }}"></td>
                            <td><label>Jefe Cumple</label></td>
                            <td><input type="text" name="jefe_cumple" value="{{ $registro->jefe_cumple }}"></td>
                        </tr>
                        <tr>
                            <td colspan="6" style="text-align: center; background-color: rgba(94, 128, 80, 0.416);">
                                Evaluación Final
                            </td>
                        </tr>
                        <tr>
                            <td><label>Calidad Labor</label></td>
                            <td><input type="text" name="calidad_labor" value="{{ $registro->calidad_labor }}"></td>
                            <td><label>Cumplimiento</label></td>
                            <td><input type="text" name="cumplimiento" value="{{ $registro->cumplimiento }}"></td>
                            <td><label>Productividad</label></td>
                            <td><input type="text" name="productividad" value="{{ $registro->productividad }}"></td>
                        </tr>
                        <tr>
                            <td><label>Relaciones</label></td>
                            <td><input type="text" name="relaciones" value="{{ $registro->relaciones }}"></td>
                            <td><label>Otras</label></td>
                            <td><input type="text" name="otras" value="{{ $registro->otras }}"></td>
                            <td><label>GH Cumple</label></td>
                            <td><input type="text" name="gh_cumple" value="{{ $registro->gh_cumple }}"></td>
                        </tr>
                        <tr>
                            <td colspan="6" style="text-align: center; background-color: rgba(94, 128, 80, 0.416);">
                                Gerencia
                            </td>
                        </tr>
                        <tr>
                            <td><label>Fecha Gerencia</label></td>
                            <td><input type="date" name="fecha_gerencia" value="{{ $registro->fecha_gerencia }}"></td>
                            <td><label>Gerencia Cumple</label></td>
                            <td><input type="text" name="gerencia_cumple" value="{{ $registro->gerencia_cumple }}"></td>
                            <td><label>Observaciones Gerencia</label></td>
                            <td><input type="text" name="observaciones_gerencia" value="{{ $registro->observaciones_gerencia }}"></td>
                        </tr>
                        <tr>
                            <td><label>Autorizado Por</label></td>
                            <td><input type="text" name="autorizado_por" value="{{ $registro->autorizado_por }}"></td>
                            <td><label>Firma Autorizado</label></td>
                            <td><img src="{{ asset($registro->firma_autorizado) }}" class="img-thumbnail" style="max-width: 120px; max-height: 60px;"></td>
                            <td><label>Asignado Elaborado</label></td>
                            <td><input type="text" name="asignado_elavorado" value="{{ $registro->asignado_elavorado }}"></td>
                        </tr>
                        <tr>
                            <td><label>Elaborado Por</label></td>
                            <td><input type="text" name="elaborado_por" value="{{ $registro->elaborado_por }}"></td>
                            <td><label>Revisado Por</label></td>
                            <td><input type="text" name="revisado_por" value="{{ $registro->revisado_por }}"></td>
                            <td><label>Aprobado Por</label></td>
                            <td><input type="text" name="aprobado_por" value="{{ $registro->aprobado_por }}"></td>
                        </tr>
                        <tr>
                            <td><label>Fecha Aprobación</label></td>
                            <td><input type="date" name="fecha_aprobacion" value="{{ $registro->fecha_aprobacion }}"></td>
                            <td><label>Creado</label></td>
                            <td><input type="text" name="created_at" value="{{ $registro->created_at }}" ></td>
                            <td><label>Actualizado</label></td>
                            <td><input type="text" name="updated_at" value="{{ $registro->updated_at }}" ></td>
                        </tr>
                    </table>
            
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-success">✅ Actualizar Registro</button>
                    </div>
                </form>
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

            <button class="btn btn-warning btn-sm" onclick="window.location='{{ url()->previous() }}'" style="margin-bottom: 5px !important; background:#ab4d1a;">
                <i class="fas fa-edit"></i>❌ Cancelar
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

