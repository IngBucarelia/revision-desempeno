<x-app-layout>
    <x-appbar />




<link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css_dascboard.css') }}">

    <div class="contenedor-principal">
        <x-sidebar />

        <div class="container mt-4 d-flex flex-column align-items-center" style="margin-bottom: 300px; margin-left:180px">
            <div class="contenido">    
                <h2 class="titulo_formulario"> Revisión de Desempeño</h2>
                <style>
    .tabla-desempeno {
        width: 100%;
        table-layout: fixed;
        border-collapse: collapse;
        font-size: 11px;
    }

    .tabla-desempeno td,
    .tabla-desempeno th {
        border: 1px solid #000;
        padding: 5px;
        word-wrap: break-word;
        vertical-align: top;
    }

    .tabla-desempeno .seccion {
        background-color: rgba(94, 128, 80, 0.3);
        text-align: center;
        font-weight: bold;
    }

    .tabla-desempeno img {
        max-width: 100px;
        max-height: 60px;
    }
</style>

<table class="tabla-desempeno">
    <tr><td colspan="6" class="seccion">INFORMACIÓN GENERAL DEL EMPLEADO</td></tr>
    <tr>
        <td><strong>ID</strong></td><td>{{ $registro->id }}</td>
        <td><strong>Fecha Solicitud</strong></td><td>{{ $registro->fecha_solicitud }}</td>
        <td><strong>Cédula</strong></td><td>{{ $registro->cedula }}</td>
    </tr>
    <tr>
        <td><strong>Nombre</strong></td><td colspan="2">{{ $registro->nombre_trabajador }}</td>
        <td><strong>Cargo</strong></td><td colspan="2">{{ $registro->cargo }}</td>
    </tr>
    <tr>
        <td><strong>Fecha Ingreso</strong></td><td>{{ $registro->fecha_ingreso }}</td>
        <td><strong>Prórrogas</strong></td><td>{{ $registro->prorrogas }}</td>
        <td><strong>Vencimiento</strong></td><td>{{ $registro->fecha_vencimiento }}</td>
    </tr>

    <tr><td colspan="6" class="seccion">HISTORIAL DISCIPLINARIO</td></tr>
    <tr>
        <td colspan="3"><strong>Llamados Atención</strong><br>{{ $registro->llamados_atencion }}@if($registro->llamados_atencion)
                                            <a href="{{ route('llamados.trabajador.detalle', ['cedula' => $registro->cedula]) }}" target="_blank" class="btn btn-info btn-sm ms-2" style="background-color: green;color:#fafafa">👁️ Ver</a>
                                        @endif</td>
        <td colspan="3"><strong>Faltas Disciplinarias</strong><br>{{ $registro->faltas_disciplinarias }}@if($registro->faltas_disciplinarias)
                                        <a href="{{ route('faltas.trabajador.detalle', ['cedula' => $registro->cedula]) }}" target="_blank" class="btn btn-info btn-sm ms-2" style="background-color: green;color:#fafafa">👁️ Ver</a>
                                        @endif</td>
    </tr>
    <tr>
        <td colspan="2"><strong>Sanciones</strong><br>{{ $registro->sanciones }}<a style="background-color: green; color:#fafafa" href="{{ route('faltas.trabajador.sancion', ['cedula' => $registro->cedula]) }}" target="_blank" class="btn btn-info btn-sm ms-2" href="#" target="_blank" class="btn btn-info btn-sm" >
                                                            👁️ Ver
</a></td>
        <td colspan="2"><strong>Inasistencias</strong><br>{{ $registro->inasistencias }}<a style="background-color: green;color:#fafafa" href="{{ route('inasistencias.trabajador.detalle', ['cedula' => $registro->cedula]) }}" target="_blank" class="btn btn-info btn-sm ms-2">👁️ Ver</a></td>
        <td colspan="2"><strong>Suspensiones</strong><br>{{ $registro->suspenciones }}<a style="background-color: green;color:#fafafa" href="{{ route('suspenciones.trabajador.detalle', ['cedula' => $registro->cedula]) }}" target="_blank" class="btn btn-info btn-sm ms-2">👁️ Ver</a>
</td>
    </tr>

    <tr><td colspan="6" class="seccion">GESTIÓN HUMANA</td></tr>
    <tr>
        <td><strong>Observaciones GH</strong></td><td colspan="5">{{ $registro->observaciones_gh }}</td>
    </tr>
    <tr>
        <td><strong>Diligenciado Por</strong></td><td colspan="2">{{ $registro->gh_diligenciado_por }}</td>
        <td><strong>Firma</strong></td>
        <td colspan="2">
            @if($registro->gh_firma)
                <img src="{{ asset($registro->gh_firma) }}"
                            style="max-width: 120px; max-height: 60px;">
            @else
                No registrada
            @endif
        </td>
    </tr>
    <tr>
        <td><strong>Fecha</strong></td><td colspan="5">{{ $registro->gh_fecha }}</td>
    </tr>

    <tr><td colspan="6" class="seccion">SEGURIDAD Y SALUD EN EL TRABAJO (SST)</td></tr>
    <tr>
        <td><strong>Cumplimiento SGSST</strong></td><td colspan="2">{{ $registro->cumplimiento_sgsst }}</td>
        <td><strong>Hábitos</strong></td><td colspan="2">{{ $registro->habitos_comportamientos }}</td>
    </tr>
    <tr>
        <td><strong>Diligenciado Por</strong></td><td colspan="2">{{ $registro->sst_diligenciado_por }}</td>
        <td><strong>Firma</strong></td>
        <td colspan="2">
            @if($registro->sst_firma)
                <img src="{{ asset($registro->sst_firma) }}">
            @else
                No registrada
            @endif
        </td>
    </tr>
    <tr>
        <td><strong>Fecha</strong></td><td colspan="5">{{ $registro->sst_fecha }}</td>
    </tr>

    <tr><td colspan="6" class="seccion">JEFE INMEDIATO</td></tr>
    <tr>
        <td><strong>Labor Actual</strong></td><td colspan="2">{{ $registro->labor_actual }}</td>
        <td><strong>Labores Desempeñadas</strong></td><td colspan="2">{{ $registro->labores_desempenadas }}</td>
    </tr>
    <tr>
        <td><strong>Diligenciado Por</strong></td><td>{{ $registro->jefe_diligenciado_por }}</td>
        <td><strong>Jefe</strong></td>
        <td colspan="3">
            @php
                $jefe_inmediato = $jefe_inmediato->firstWhere('id', $registro->jefe_inmediato);
            @endphp
            {{ $jefe_inmediato->nombre ?? 'Sin asignación' }}
        </td>
    </tr>
    <tr>
        <td><strong>Firma</strong></td><td>
            <img src="{{ asset($registro->jefe_firma) }}">
        </td>
        <td><strong>Fecha</strong></td><td>{{ $registro->jefe_fecha }}</td>
        <td><strong>Cumple</strong></td><td>{{ $registro->jefe_cumple }}</td>
    </tr>

    <tr><td colspan="6" class="seccion">EVALUACIÓN FINAL</td></tr>
    <tr>
        <td><strong>Calidad</strong></td><td>{{ $registro->calidad_labor }}</td>
        <td><strong>Cumplimiento</strong></td><td>{{ $registro->cumplimiento }}</td>
        <td><strong>Productividad</strong></td><td>{{ $registro->productividad }}</td>
    </tr>
    <tr>
        <td><strong>Relaciones</strong></td><td>{{ $registro->relaciones }}</td>
        <td><strong>Otras</strong></td><td>{{ $registro->otras }}</td>
        <td><strong>GH Cumple</strong></td><td>{{ $registro->gh_cumple }}</td>
    </tr>

    <tr><td colspan="6" class="seccion">GERENCIA</td></tr>
    <tr>
        <td><strong>Fecha</strong></td><td>{{ $registro->fecha_gerencia }}</td>
        <td><strong>Cumple</strong></td><td>{{ $registro->gerencia_cumple }}</td>
        <td><strong>Observaciones</strong></td><td>{{ $registro->observaciones_gerencia }}</td>
    </tr>
    <tr>
        <td><strong>Autorizado Por</strong></td><td colspan="2">{{ $registro->autorizado_por }}</td>
        <td><strong>Firma</strong></td><td colspan="2">
            <img src="{{ asset($registro->firma_autorizado) }}">
        </td>
    </tr>

    <tr><td colspan="6" class="seccion">AUDITORÍA</td></tr>
    <tr>
        <td><strong>Elaborado Por</strong></td><td>{{ $registro->gh_diligenciado_por }}</td>
        <td><strong>Revisado Por</strong></td><td>{{ $registro->jefe_diligenciado_por }}</td>
        <td><strong>Aprobado Por</strong></td><td>{{ $registro->autorizado_por }}</td>
    </tr>
    <tr>
        <td><strong>Fecha Aprobación</strong></td><td>{{ $registro->fecha_aprobacion }}</td>
        <td><strong>Creado</strong></td><td>{{ $registro->created_at }}</td>
        <td><strong>Actualizado</strong></td><td>{{ $registro->updated_at }}</td>
    </tr>
</table>

                
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
            
            <button onclick="verificarOtrosi('{{ $registro->cedula }}')" class="btn btn-success btn-sm">
                ✍ Crear Otrosí
            </button><br>

            <a href="{{ route('revision.imprimir', $registro->id) }}" 
                class="btn btn-outline-dark btn-sm"
                style="color: teal"
                target="_blank" 
                style="margin: 10px 0;">
                <i class="fas fa-file-pdf"></i>🖨️ Imprimir PDF
            </a><br>
            <button class="btn btn-warning btn-sm" onclick="window.location='{{ url()->previous() }}'" style="margin-bottom: 5px !important; background:#ab4d1a;">
                <i class="fas fa-edit"></i> Cancelar
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

            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
            function verificarOtrosi(cedula) {
                fetch(`/otrosis/verificar/${cedula}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.existe) {
                            Swal.fire({
                                title: 'Otrosí ya existente',
                                html: `Ya existe un Otrosí creado el <strong>${data.fecha}</strong>.<br>¿Deseas crear uno nuevo?`,
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonText: 'Sí, crear nuevo',
                                cancelButtonText: 'No, volver' 
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = `/otrosis/create/${cedula}`;
                                }
                            });
                        } else {
                            window.location.href = `/otrosis/create/${cedula}`;
                        }
                    });
            }
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

