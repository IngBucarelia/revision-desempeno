<x-app-layout>
    <x-appbar />

    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css_dascboard.css') }}">

    <div class="contenedor-principal">
        <x-sidebar />
       
        <div class="contenido" style="height: 500px">    
            <div class="container mt-4">
        <h3 class="text-success text-center">REGISTRO DE NOVEDAD DE CONTRATO</h3>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('novedades_contrato.store') }}">
            @csrf

            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Fecha de reporte:</label>
                <div class="col-sm-4">
                    <input type="date" name="fecha_reporte" class="form-control" value="{{ date('Y-m-d') }}" required>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">Marque con una X el tipo de novedad</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tipo_novedad" value="D" required>
                    <label class="form-check-label">D = Desvinculación</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tipo_novedad" value="R">
                    <label class="form-check-label">R = Renovación</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="tipo_novedad" value="C">
                    <label class="form-check-label">C = Cambio Modalidad de Contrato</label>
                </div>
            </div>

            <table class="table table-bordered">
                <thead class="table-success">
                    <tr>
                        <th>NOMBRE TRABAJADOR</th>
                        <th>CODIGO TRABAJADOR</th>
                        <th>FECHA DE NOVEDAD</th>
                        <th>TIEMPO DE LA PRORROGA</th>
                        <th>TIPO CONTRATO</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <input type="text" readonly name="nombre_trabajador" class="form-control" value="{{ $empleado->nombre ?? '' }}" readonly required>
                        </td>
                        <td>
                            <input type="text" readonly name="codigo_trabajador" class="form-control" value="{{ $empleado->codigo ?? '' }}" readonly>
                        </td>
                        <td>
                            <input type="date" readonly name="fecha_novedad" class="form-control" value="{{ $otrosi->fecha_renovacion ?? '' }}" required>
                        </td>
                        <td>
                            <input type="text" readonly name="tiempo_prorroga" class="form-control" value="{{ $otrosi->periodo ?? '' }}">
                        </td>
                        <td>
                            <select name="tipo_contrato" class="form-control" required>
                                <option value="">Seleccione uno</option>
                                <option value="Obra o Labor" {{ (isset($otrosi) && $otrosi->tipo_contrato == 'Obra o Labor') ? 'selected' : '' }}>Obra o Labor</option>
                                <option value="Término Fijo" {{ (isset($otrosi) && $otrosi->tipo_contrato == 'Término Fijo') ? 'selected' : '' }}>Término Fijo</option>
                                <option value="Indefinido" {{ (isset($otrosi) && $otrosi->tipo_contrato == 'Indefinido') ? 'selected' : '' }}>Indefinido</option>
                                <option value="Prestación de Servicios" {{ (isset($otrosi) && $otrosi->tipo_contrato == 'Prestación de Servicios') ? 'selected' : '' }}>Prestación de Servicios</option>
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="mb-3">
                <label class="form-label">Observaciones:</label>
                <textarea name="observaciones" class="form-control" rows="3"></textarea>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <label>Diligenciado por:</label>
                    <input type="text" name="diligenciado_por" readonly value="{{ Auth::user()->name }}" class="form-control">
                </div>
                <div class="col-md-6">
                    <label>Autorizado por:</label>
                    <input type="text" name="autorizado_por" value="Nancy Elena Romero Narvaez" readonly class="form-control">
                </div>
            </div>

            <div class="text-center">
                <button class="btn btn-success">Guardar Novedad</button>
            </div>
        </form>
        <br>
                 <button class="btn btn-warning btn-sm" onclick="window.location='{{ url()->previous() }}'" style="margin-bottom: 5px !important; background:#ab4d1a;">
                </i>❌ Cancelar
            </button><br>
    </div>
        </div>
    </div>
 <script>
            document.querySelector('input[name="codigo_trabajador"]').addEventListener('change', function () {
                const documento = this.value;
            
                fetch(`/buscar-empleado/${documento}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'found') {
                            
                            document.querySelector('input[name="codigo_trabajador"]').value = data.empleado.codigo;
                            document.querySelector('input[name="nombre_trabajador"]').value = data.empleado.nombre;
                           // si no hay, queda vacío
                        } else {
                            alert('El usuario no existe. Por favor crear empleado para continuar .');
                            window.location.href = '/empleados/create'; // ajusta a tu ruta real
                        }
                    });
            });
            </script>
    <x-footer />
        <script>
            function calcularDias() {
                    const fechaInicio = document.getElementById('fecha_inicio').value;
                    const fechaFin = document.getElementById('fecha_fin').value;
                    
                    if (fechaInicio && fechaFin) {
                        const inicio = new Date(fechaInicio);
                        const fin = new Date(fechaFin);
                        
                        // Si la fecha fin es menor, intercambia los valores
                        if (fin < inicio) {
                            alert("¡La fecha fin no puede ser anterior a la fecha inicio!");
                            document.getElementById('fecha_fin').value = fechaInicio; // Corrige automáticamente
                            fin = inicio; // Reasigna para el cálculo
                        }
                        
                        const diffDays = Math.ceil((fin - inicio) / (86400000)) + 1;
                        document.getElementById('total_dias').value = diffDays;
                    }
                }
                
        </script>
        <script>
                $(document).ready(function () {
            $('#select-empleado').on('change', function () {
                const cedula = $(this).val();
                const selectFaltas = $('#codigo_falta');

                if (cedula) {
                    fetch(`/buscar-faltas-disciplinarias/inasistencias/${cedula}`)
                        .then(response => response.json())
                        .then(data => {
                            selectFaltas.empty().append('<option value="">Seleccione una falta disciplinaria</option>');

                            data.forEach(falta => {
                                selectFaltas.append(
                                    $('<option>', {
                                        value: falta.id,
                                        text: `Falta #${falta.id} - ${falta.descripcion_falta} - ${falta.fecha_reporte}`
                                    })
                                );
                            });
                        });
                } else {
                    selectFaltas.empty().append('<option value="">Seleccione una falta disciplinaria</option>');
                }
            });
        });

        </script>

@if(isset($novedadExistente))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = new bootstrap.Modal(document.getElementById('modalNovedadExistente'));
        modal.show();
    });
</script>
@endif


  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- jQuery (requerido) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@if(isset($novedadExistente))
<!-- Modal si ya existe una novedad -->
<div class="modal fade" id="modalNovedadExistente" tabindex="-1" aria-labelledby="modalNovedadExistenteLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-warning text-dark">
        <h5 class="modal-title">Ya existe una Novedad Registrada</h5>
      </div>
      <div class="modal-body">
        <p><strong>Fecha de Novedad:</strong> {{ $novedadExistente->fecha_novedad }}</p>
        <p><strong>Tipo de Novedad:</strong> 
            @if($novedadExistente->tipo_novedad == 'D') Desvinculación
            @elseif($novedadExistente->tipo_novedad == 'R') Renovación
            @elseif($novedadExistente->tipo_novedad == 'C') Cambio de modalidad
            @endif
        </p>
        <p><strong>Observaciones:</strong> {{ $novedadExistente->observaciones ?? 'Sin observaciones' }}</p>
        <p class="text-danger">¿Está seguro que desea continuar y registrar un nuevo registro de novedad?</p>
      </div>
      <div class="modal-footer">
        <a href="{{ route('novedades.verificarCedula') }}" class="btn btn-secondary">Cancelar</a>
        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Continuar</button>
      </div>
    </div>
  </div>
</div>
@endif

</x-app-layout>
