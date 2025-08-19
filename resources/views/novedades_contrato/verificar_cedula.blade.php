<x-app-layout>
    <x-appbar />

    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css_dascboard.css') }}">

    <div class="contenedor-principal">
        <x-sidebar />
       
        <div class="contenido" style="height: 100px">    
            <div class="container mt-4" >
                <h3 class="text-success text-center">REGISTRO DE NOVEDAD DE CONTRATO</h3>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif


                    <div class="mb-3 row">
                        <div class="container mt-5">
                <h4>Verificar Documento para Novedad de Contrato</h4>
                <form id="form-verificacion">
                    <div class="mb-3">
                        <label for="cedula" class="form-label">Número de Documento:</label>
                        <input type="text" name="cedula" id="cedula" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-success">🔍✅ Verificar</button>
                </form><br>
                 <button class="btn btn-warning btn-sm" onclick="window.location='{{ route('dashboard'); }}'" style="margin-bottom: 5px !important; background:#ab4d1a;">
                </i>❌ Cancelar
            </button><br>
            </div>

            <!-- Modal Bootstrap -->
            <div class="modal fade" id="modalOtros" tabindex="-1" aria-labelledby="modalOtrosLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-success text-white">
                            <h5 class="modal-title">Información Revisión de Desempeño </h5>
                          
                        </div>
                        <div class="modal-header bg-success text-white">
                            <span>El usuario obtuvo la siguiente calificación en su revisión de desempeño </span>
                        </div>
                        <div class="modal-body" id="contenidoModal"></div>
                        <div class="modal-footer">
                            <a id="btnContinuar" class="btn btn-success">✅ Continuar con Novedad</a>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" ><a style="margin-bottom: -25px!important">❌ Cancelar</a></button>
                        </div>
                    </div>
                </div>
            </div>

           <script>
            document.getElementById('form-verificacion').addEventListener('submit', function (e) {
                e.preventDefault();
                let cedula = document.getElementById('cedula').value;

                console.log("Enviando cédula:", cedula); // 🚀 Debug

                fetch('{{ route('novedades.buscarOtrosSi') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ cedula: cedula })
                })
                .then(res => res.json())
                .then(data => {
                    console.log("Respuesta del servidor:", data); // 🚀 Debug

                    if (data.success) {
                        let html = `
                            <p><strong>Nombre:</strong> ${data.data.nombre_trabajador}</p>
                            <p><strong>Documento:</strong> ${data.data.cedula}</p>
                            <p><strong>Fecha Aprobación:</strong> ${data.data.fecha_aprobacion}</p>
                            <p><strong>Estado:</strong> ${data.data.estado}</p>
                            <p><strong>SST Cumple:</strong> ${data.data.sst_cumple}</p>
                            <p><strong>Jefe Cumple:</strong> ${data.data.jefe_cumple}</p>
                            <p><strong>Gerencia Cumple:</strong> ${data.data.gerencia_cumple}</p>
                        `;
                        document.getElementById('contenidoModal').innerHTML = html;
                        document.getElementById('btnContinuar').href = `/novedades/create?cedula=${cedula}`;
                        let modal = new bootstrap.Modal(document.getElementById('modalOtros'));
                        modal.show();
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error("Error en la solicitud fetch:", error); // 🚨 Debug de errores
                });
            });
        </script>

                </div>
            </div>
        
        </div></div>
    <x-footer />

    
    
    
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- jQuery (requerido) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- Bootstrap Bundle (incluye Popper.js) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</x-app-layout>
