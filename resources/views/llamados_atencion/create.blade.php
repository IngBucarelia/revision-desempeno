<x-app-layout>
    <x-appbar />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />



<link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css_dascboard.css') }}">

    <div class="contenedor-principal">
        <x-sidebar />

        <div class="container mt-4 d-flex flex-column align-items-center" style="margin-bottom: 300px">
            <div class="contenido">    
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
                
                    <h2 class="titulo_formulario">Crear Nuevo Llamado / Recordatorio </h2>
                    <form method="POST" action="{{ route('llamados_atencion.store') }}" enctype="multipart/form-data">
                        @csrf
                    
                    <table class="table table-hover table-striped text-center mx-auto">
                        <tr>
                            <td colspan="5" style="text-align: center; background-color: rgba(94, 128, 80, 0.416);">Información Básica del Empleado </td>
                        </tr>
                            <tr>
                                <td><label for=""># Contrato</label></td>
                                <td ><label for="">Numero Documento</label></td>
                                <td><label for="">Nombre Empleado</label></td>
                                <td><label for="">Labor</label></td>                        
                            </tr>
                            <tr>
                                <td> <input type="number" name="codigo" placeholder="Código" required></td>
                                <td ><input type="text" name="documento" placeholder="# Documento Trabajador" required></td>
                                <td><input type="text" name="trabajador" placeholder="Nombre Trabajador" required></td> 
                                <td><input type="text" name="labor" placeholder="Labor" required></td>            
                            </tr>
                            <tr>
                                <td colspan="5" style="text-align: center; background-color: rgba(94, 128, 80, 0.416);">Información Fechas del Reporte </td>
                            </tr>
                            <tr>
                                <td colspan="2" ><label for="">Fecha Reporte</label></td>
                               
                                <td colspan="3"><label  for="">Fecha Falta</label></td> 
                                 
                            </tr>
                            <tr>
                                <td colspan="2"><input  type="date" name="fecha_notificacion" placeholder="Fecha Reporte" required></td>
                                
                                <td colspan="3"> <input  type="date" name="fecha_falta" placeholder="Fecha Falta" required></td>  
                                       
                            </tr>
                            <tr>
                                <td colspan="5" style="text-align: center; background-color:  rgba(94, 128, 80, 0.416);">Información  de la Falta </td>
                            </tr>
                            <tr>
                                <td colspan="2"><label for="">Asunto</label></td>  
                                <td colspan="3"><label for="">Clase Falta</label></td>                             
                            </tr>
                            <tr>
                                <td colspan="2"><input type="text" name="asunto" placeholder="asunto del llamado" required></td>  
                                <td colspan="3">
                                    
                                        <div class="mb-3">
                                            <div class="d-flex align-items-center">
                                                <select name="clase_falta" id="select-clase-falta" class="form-control me-2" required style="width: 100%;">
                                                    <option value="">Seleccione una clase</option>
                                                    @foreach($clasesFalta as $clase)
                                                        <option value="{{ $clase->nombre }}">{{ $clase->nombre }}</option>
                                                    @endforeach
                                                </select>

                                                <a href="{{ route('clases_faltas.create') }}" 
                                                class="btn btn-success" 
                                                style="white-space: nowrap;" 
                                                title="Agregar nueva clase" target="_blank">
                                                    <i class="fas fa-plus"></i>
                                                </a>
                                            </div>
                                        </div>                                    
                                </td>                            
                            </tr>
                            <tr>
                               
                                <td colspan="2"><label for="">Descripció de la Falta</label></td>
                                <td colspan="3"><label for="">Observaciones</label></td>
                                
                            </tr>
                            <tr>
                                
                                <td colspan="2"><textarea style="width: 400px" class="textarea-estilizado" name="descripcion_falta" placeholder="Descripción Falta" required></textarea><td>
                                <td colspan="2"><textarea class="textarea-estilizado" name="observaciones" placeholder="Observaciones" ></textarea><td>
                            
                            </tr>
                           
                           
                            
                            
                            <tr>
                                <td colspan="5" style="text-align: center; background-color:  rgba(94, 128, 80, 0.416);;">Zona de Autenticación de Quien Notifica</td>

                            </tr>
                            <tr>
                                <td colspan="1"># Documento</td>
                                <td colspan="2"> Nombre</td>
                                <td colspan="2"><label for="">Cargo </label></td>
                            </tr>
                            <tr>
                                <td colspan="1"><input type="number" name="documento_notificacion" placeholder="Documento de quien notifca" required></td>
                                <td colspan="2"><input type="text" name="nombre_notificacion" placeholder="nombre de quien notifica" required></td>
                                <td colspan="2"> <input type="text" name="cargo" placeholder="Cargo de quien notifica" required></td>
                            </tr>
                            <tr>
                                <td colspan="5" style="text-align: center; background-color:  rgba(94, 128, 80, 0.416);;"> Evidencia en PDF </td>
                            </tr>
                            <tr>
                                <td colspan="2"><label for="pdf_evidencia">Adjuntar Evidencia (PDF)</label></td>
                                <td colspan="3">    <input type="file" name="pdf_evidencia" accept="application/pdf"></td>
                            </tr>
                        </table>
                        <button type="submit">📝 Agregar Llamado</button>
                        </form>
                
                       
        

                        <script>
                            function previewFirma(event) {
                                var output = document.getElementById('firma_preview');
                                output.src = URL.createObjectURL(event.target.files[0]);
                                output.style.display = 'block';
                            }
                        </script>

<script>
    document.querySelector('input[name="documento"]').addEventListener('change', function () {
        const documento = this.value;
    
        fetch(`/buscar-empleado/${documento}`)
            .then(response => response.json())
            .then(data => {
                if (data.status === 'found') {
                    document.querySelector('input[name="codigo"]').value = data.empleado.numero_contrato;
                    document.querySelector('input[name="documento"]').value = data.empleado.codigo;
                    document.querySelector('input[name="trabajador"]').value = data.empleado.nombre;
                    document.querySelector('input[name="labor"]').value = data.empleado.labor ?? ''; // si no hay, queda vacío
                } else {
                    alert('El usuario no existe. Por favor crear empleado para continuar .');
                    window.location.href = '/empleados/create'; // ajusta a tu ruta real
                }
            });
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

            <button class="btn btn-warning btn-sm" onclick="window.location='{{ route('dashboard') }}'" style="margin-bottom: 5px !important; background:#ab4d1a;">
                </i>🏠	 Inicio
            </button><br>
        </div>
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

        <!-- CSS de Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- JS de jQuery y Select2 -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('#select-clase-falta').select2({
            placeholder: "Seleccione una clase de falta...",
            allowClear: true,
            width: '100%'
        });
    });
</script>

</div>

<x-footer />

</x-app-layout>

