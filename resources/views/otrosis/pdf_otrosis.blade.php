<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>R-48-207 - Faltas Disciplinarias</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            margin: 100px 40px 100px 40px; /* espacio para encabezado y footer */
        }
        header {
            position: fixed;
            top: -20px;
            left: 0;
            right: 0;
            height: 80px;
        }
        footer {
            position: fixed;
            bottom: 8px;
            left: 0;
            right: 0;
            height: 80px;
        }
        .content {
            margin-top: 80px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        td, th {
            border: 1px solid #000;
            padding: 4px;
            vertical-align: top;
        }
    </style>
</head>
<body>


   

    <div class="contenedor-principal">
        
       <div class="contenido" style="height: 800px !important">    
    <header>
        <img src="{{ public_path('images/encabezado_llamado.png') }}" style="width: 100%;">
    </header>
       <div class="container my-5" >
    <div class="card p-4 shadow-sm" style="height: 100px !important; margin-top:80px;">
        <h2 style="text-align: center" class="text-center fw-bold mb-4">OTRO  SÍ  AL   CONTRATO   DE  TRABAJO   SUSCRITO    ENTRE      <br>     PALMAS OLEAGINOSAS  BUCARELIA S.A.S. y  {{ strtoupper($proceso->empleado->nombre) }}</h2>
        <br><p class="justificado">
            Entre los suscritos a saber; <strong>NANCY ELENA ROMERO NARVAEZ</strong>, identificada con la cédula de ciudadanía número <strong>1.104.124.627 </strong>expedida en Puerto Wilches , quien obra en nombre de la empresa <strong>PALMAS OLEAGINOSAS BUCARELIA S.A.S.</strong> persona jurídica de derecho privado con domicilio en Bucaramanga, que en adelante se llamará el <strong>EMPLEADOR</strong> por una parte y por la otra  <strong>{{ $proceso->empleado->nombre }}</strong>, identificado (a) con cédula <strong>{{ $proceso->empleado->codigo }}</strong> como aparece al pie de su correspondiente firma, quien obra en nombre propio y quien en adelante se llamará el <strong>TRABAJADOR</strong>, conocidos como partes contratantes dentro del contrato de trabajo a término fijo , suscrito el <strong>{{$proceso->empleado->fecha_ingreso}} </strong> y estando plenamente facultados y sin ningún impedimento legal para ello de consumo manifestamos que modificamos y adicionamos la siguiente cláusula del contrato original: </strong><strong>PRIMERA: </strong> El presente contrato de trabajo se prorrogará por un período de <strong>{{ $proceso->periodo }}</strong> contados a partir del día <strong>{{ \Carbon\Carbon::parse($proceso->fecha_renovacion)->translatedFormat('d \d\e F \d\e Y') }}</strong>. (Prórroga {{ $proceso->numero_prorrogas }}).
       
        </p>
        <p class="justificado mt-3">
           En lo demás las partes ratifican el contrato inicial con las anteriores y demás modificaciones y adiciones pasadas.  Así mismo,  derogan las cláusulas que sean contrarias e incompatibles con el presente <strong> OTRO SI </strong>. Para constancia se firma en Puerto Wilches, el <strong>{{ now()->translatedFormat('d \d\e F \d\e Y') }}</strong>.
        </p><br><br>
       <table style="width: 100%; margin-top: 60px; text-align: center; border: none;">
            <tr>
                <td style="border: none;">
                    _________________________<br>
                    <strong>NANCY ELENA ROMERO NARVAEZ</strong><br>
                    EL EMPLEADOR<br>
                    C.C. 1.104.124.627
                </td>
                <td style="border: none;">
                    _________________________<br>
                    <strong>{{ strtoupper($proceso->empleado->nombre) }}</strong><br>
                    EL TRABAJADOR<br>
                    C.C. {{ $proceso->empleado->codigo }}
                </td>
            </tr>
        </table>

<style>
    p{
        font-size: 14px;
        text-align: justify;    }
</style>

    </div>
</div>
 <footer>
        <img src="{{ public_path('images/footer_llamado.png') }}" style="width: 100%;">
    </footer>
        </div>
        
    </div>

</body>

</html>
