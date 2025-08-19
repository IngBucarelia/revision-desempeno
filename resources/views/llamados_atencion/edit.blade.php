<x-app-layout>
    <x-appbar />




<link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css_dascboard.css') }}">

    <div class="contenedor-principal">
        <x-sidebar />

        <div class="container mt-4 d-flex flex-column align-items-center" style="margin-bottom: 300px">
            <div class="contenido">    

                
                    <h2>Ingresar Nuevo Llamado / Recordatorio al Empleado</h2>
                    <form method="POST" action="{{ route('llamados_atencion.update', $llamado->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                    
                    <table class="table table-hover table-striped text-center mx-auto">
                        <tr>
                            <td colspan="5" style="text-align: center; background-color: rgba(94, 128, 80, 0.416);">Información Básica del Empleado </td>
                        </tr>
                            <tr>
                                <td><label for="">Código</label></td>
                                <td colspan="2"><label for="">Numero Documento</label></td>
                                <td><label for="">Nombre Empleado</label></td>
                                <td><label for="">Labor</label></td>                        
                            </tr>
                            <tr>
                                <td> <input type="number" name="codigo" placeholder="Código"value="{{ $llamado->codigo}}" required></td>
                                <td colspan="2"><input type="text" name="documento" value="{{ $llamado->documento}}" placeholder="# Documento Trabajador" required></td>
                                <td><input type="text" name="trabajador" value="{{ $llamado->trabajador}}" placeholder="Nombre Trabajador" required></td> 
                                <td><input type="text" name="labor" value="{{ $llamado->labor}}" placeholder="Labor" required></td>            
                            </tr>
                            <tr>
                                <td colspan="5" style="text-align: center; background-color: rgba(94, 128, 80, 0.416);">Información Fechas del Reporte </td>
                            </tr>
                            <tr>
                                <td colspan="2" ><label for="">Fecha Reporte</label></td>
                               
                                <td colspan="3"><label  for="">Fecha Falta</label></td> 
                                 
                            </tr>
                            <tr>
                                <td colspan="2"><input  type="date" name="fecha_notificacion" value="{{ $llamado->fecha_notificacion}}" placeholder="Fecha Reporte" required></td>
                                
                                <td colspan="3"> <input  type="date" name="fecha_falta" value="{{ $llamado->fecha_falta}}" placeholder="Fecha Falta" required></td>  
                                       
                            </tr>
                            <tr>
                                <td colspan="5" style="text-align: center; background-color:  rgba(94, 128, 80, 0.416);">Información  de la Falta </td>
                            </tr>
                            <tr>
                                <td colspan="2"><label for="">Asunto</label></td>  
                                <td colspan="3"><label for="">Clase Falta</label></td>                             
                            </tr>
                            <tr>
                                <td colspan="2"><input type="text" name="asunto" value="{{ $llamado->asunto}}" placeholder="asunto del llamado" required></td>  
                                <td colspan="3">
                                    <select name="clase_falta" required>
                                        <option value="" disabled selected>Seleccione una clase</option>
                                        <option value="disciplinaria" {{ $llamado->clase_falta == 'disciplinaria' ? 'selected' : '' }}>Disciplinaria</option>
                                        <option value="calidad labor"{{ $llamado->clase_falta == 'calidad labor' ? 'selected' : '' }}>Calidad Labor</option>
                                    </select>
                                </td>                             
                            </tr>
                            <tr>
                               
                                <td colspan="5"><label for="">Descripció de la Falta</label></td>
                                
                            </tr>
                            <tr>
                                
                                <td colspan="4"><textarea style="margin-left: 30px" class="textarea-estilizado" name="descripcion_falta" required>{{ $llamado->descripcion_falta}}</textarea><td>
                            </tr>
                           
                           
                            
                            
                            <tr>
                                <td colspan="5" style="text-align: center; background-color:  rgba(94, 128, 80, 0.416);;">Zona de Autenticación de Quien Notifica</td>

                            </tr>
                            <tr>
                                <td colspan="1"># Documento</td>
                                <td colspan="2"> Nombre</td>
                                <td colspan="2">>Cargo </label></td>
                            </tr>
                            <tr>
                                <td colspan="1"><input type="number" name="documento_notificacion" value="{{ $llamado->documento_notificacion}}" required></td>
                                <td colspan="2"><input type="text" name="nombre_notificacion" value="{{ $llamado->nombre_notificacion}}" required></td>
                                <td colspan="2"> <input type="text" name="cargo" value="{{ $llamado->cargo}}" required></td>
                            </tr>
                            <tr>
                                <td colspan="5"><label for="">Firma Notificacion </label></td>
                                
                            </tr>
                            <tr>
                                <td colspan="5" style="text-align: center;">
                                    <label for="firma_notificacion" class="form-label">Firma:</label>
                                    <br>
                                    @if($llamado->firma_notificacion)
                                    <img id="firma_preview" src="{{ asset('storage/' . $llamado->firma_notificacion) }}" 
     alt="Firma" style="max-width: 400px; display: block; margin: auto;">

                               
                                        <br>
                                        <button type="button" class="btn btn-danger" onclick="resetFirma()">Quitar firma</button>
                                        <input type="hidden" name="eliminar_firma" id="eliminar_firma" value="0">
                                    @else
                                        <textarea id="firma_textarea" class="form-control" name="firma_notificacion_texto"
                                                placeholder="Firme aquí" style="color: rgba(0, 0, 0, 0.5); font-style: italic;"></textarea>
                                    @endif
                                </td>
                                
                            </tr>
                            <tr>
                                <td colspan="5">
                                    <input type="file" id="firma_input" name="firma_notificacion" accept="image/*" 
                                            class="form-control" onchange="previewFirma(event)">
                                </td>
                            </tr>
                            
                            <script>

                        document.addEventListener("DOMContentLoaded", function () {
                            const firmaPreview = document.getElementById('firma_preview');

                            if (!firmaPreview.src || firmaPreview.src === window.location.href) {
                                firmaPreview.style.display = 'none';
                            }
                        });
                            document.getElementById('firma_input').addEventListener('change', function(event) {
                                const input = event.target;
                                const preview = document.getElementById('firma_preview');
                                const textarea = document.getElementById('firma_textarea');
                                const quitarFirmaBtn = document.getElementById('quitar_firma');
                            
                                if (input.files && input.files.length > 0) {
                                    const reader = new FileReader();
                                    reader.onload = function(e) {
                                        preview.src = e.target.result;
                                        preview.style.display = 'block'; // Mostrar imagen
                                        textarea.style.display = 'none'; // Ocultar textarea
                                        textarea.value = ''; // Limpiar contenido del textarea
                                        quitarFirmaBtn.style.display = 'block'; // Mostrar botón de quitar firma
                                    };
                                    reader.readAsDataURL(input.files[0]);
                                } else {
                                    resetFirma();
                                }
                            });
                            
                            function resetFirma() {
                                document.getElementById('firma_preview').style.display = 'none';
                                document.getElementById('firma_preview').src = '';
                                document.getElementById('firma_textarea').style.display = 'block';
                                document.getElementById('firma_input').value = ''; // Limpiar input file
                                document.getElementById('quitar_firma').style.display = 'none'; // Ocultar botón
                            }
                            </script>
                            
                                     
                       
                          
                        </table>
                        <button type="submit">Agregar Proceso Disciplinaria</button>
                        </form>
                
                       
        

                        <script>
                            function previewFirma(event) {
                                var output = document.getElementById('firma_preview');
                                output.src = URL.createObjectURL(event.target.files[0]);
                                output.style.display = 'block';
                            }
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
                <i class="fas fa-edit"></i> Inicio
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
</div>

<x-footer />

</x-app-layout>

