<x-app-layout>
    <x-appbar />

    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css_dascboard.css') }}">

    <div class="contenedor-principal">
        <x-sidebar />
       <div class="contenido" style="height: 800px !important">    
       <div class="container my-5" >
    <div class="card p-4 shadow-sm" style="height: 100px !important">
        <h4 class="text-center fw-bold mb-4">OTRO  SÍ  AL   CONTRATO   DE  TRABAJO   SUSCRITO    ENTRE           PALMAS OLEAGINOSAS  BUCARELIA S.A.S. y  {{ strtoupper($otrosi->empleado->nombre) }}</h4>
        <p class="justificado">
            Entre los suscritos a saber; <strong>NANCY ELENA ROMERO NARVAEZ</strong>, identificada con la cédula de ciudadanía número 1.104.124.627 expedida en Puerto Wilches , quien obra en nombre de la empresa <strong>PALMAS OLEAGINOSAS BUCARELIA S.A.S.</strong>persona jurídica de derecho privado con domicilio en Bucaramanga, que en adelante se llamará el <strong>EMPLEADOR</strong> por una parte y por la otra  <strong>{{ $otrosi->empleado->nombre }}</strong>, identificado (a) con cédula <strong>{{ $otrosi->empleado->codigo }}</strong> como aparece al pie de su correspondiente firma, quien obra en nombre propio y quien en adelante se llamará el <strong>TRABAJADOR</strong>, conocidos como partes contratantes dentro del contrato de trabajo a término fijo , suscrito el <strong>{{$otrosi->empleado->fecha_ingreso}} </strong> y estando plenamente facultados y sin ningún impedimento legal para ello de consumo manifestamos que modificamos y adicionamos la siguiente cláusula del contrato original: </strong><strong>PRIMERA: </strong> El presente contrato de trabajo se prorrogará por un período de <strong>{{ $otrosi->periodo }}</strong> contados a partir del día <strong>{{ \Carbon\Carbon::parse($otrosi->fecha_renovacion)->translatedFormat('d \d\e F \d\e Y') }}</strong>. (Prórroga {{ $otrosi->numero_prorrogas }}).
       
        </p>
        <p class="justificado mt-3">
           En lo demás las partes ratifican el contrato inicial con las anteriores y demás modificaciones y adiciones pasadas.  Así mismo,  derogan las cláusulas que sean contrarias e incompatibles con el presente OTRO SI. Para constancia se firma en Puerto Wilches, el <strong>{{ now()->translatedFormat('d \d\e F \d\e Y') }}</strong>.
        </p>
        <div class="row text-center mt-5">
            <div class="justificado col-md-6">
                <p>_________________________<br><strong>NANCY ELENA ROMERO NARVAEZ</strong><br>EL EMPLEADOR<br>C.C. 1.104.124.627</p>
            </div>
            <div class="justificado col-md-6">
                <p>_________________________<br><strong>{{ strtoupper($otrosi->empleado->nombre) }}</strong><br>EL TRABAJADOR<br>C.C. {{ $otrosi->empleado->codigo }}</p>
            </div>
        </div>

        <a href="{{ route('otrosis.imprimir', $otrosi->id) }}" 
class="btn btn-outline-dark btn-sm"            style="color: teal" 
            target="_blank" 
            style="margin: 10px 0;">
            <i class="fas fa-file-pdf"></i>🖨️ Imprimir en PDF
            </a>
              <button class="btn btn-warning btn-sm" onclick="window.location='{{ url()->previous() }}'" style="margin-bottom: 5px !important; background:#ab4d1a;">
                <i class="fas fa-edit"></i> ❌ Cancelar
            </button><br>
    </div>
</div>

        </div>
    </div>

    
<style>
    .justificado {
        text-align: justify;
    }
</style>
    <x-footer />
 <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- jQuery (requerido) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</x-app-layout>

