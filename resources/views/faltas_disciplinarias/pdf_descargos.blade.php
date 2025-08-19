<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acta de Descargos - {{ $proceso->codigo }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            font-size: 12pt;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            height: 80px;
        }
        .title {
            font-size: 14pt;
            font-weight: bold;
            text-align: center;
            margin: 15px 0;
        }
        .content {
            text-align: justify;
        }
        .firma {
            margin-top: 50px;
            border-top: 1px solid #000;
            width: 250px;
            display: inline-block;
            text-align: center;
            margin-right: 30px;
        }
        .page-break {
            page-break-after: always;
        }
        .text-underline {
            text-decoration: underline;
        }
        .text-bold {
            font-weight: bold;
        }
        .mt-4 {
            margin-top: 16px;
        }
        .mb-4 {
            margin-bottom: 16px;
        }
    </style>
</head>
<body>

    <header>
        <img src="{{ public_path('images/encabezado_llamado.png') }}" style="width: 100%;">
    </header>


    <div class="header">
        <img src="{{ public_path('images/logo_empresa.png') }}" alt="Logo Empresa">
        <div class="title">ACTA DE DESCARGOS</div>
    </div>

    <div class="content">
        <p>En Puerto Wilches, a los {{ $fecha_actual }} siendo las {{ $hora_actual }} en la Sala de Gestión Humana donde funcionan las dependencias de la empresa PALMAS OLEAGINOSAS BUCARELIA S.A.S., se reúnen: por el Sindicato acompaña la diligencia el señor ANGEL MIGUEL CONDE TAPIAY RAFAEL ERNESTO OLIVEROS DAVILA por la empresa la señora NANCY ELENA ROMERO NARVAEZ, Directora de Gestión Humana.</p>

        <p class="mt-4">El objeto fundamental de la presente diligencia, es el de escuchar en descargos al señor <span class="text-bold">{{ $proceso->nombre_trabajador }}</span> identificado con cédula de ciudadanía número <span class="text-bold">{{ $proceso->numero_documento_trabajador }}</span>, respecto a los hechos relacionados con el presunto incumplimiento de obligaciones especiales del trabajador y violación de prohibiciones.</p>

        <p class="mt-4">Hechos que constituyen un presunto incumplimiento a los deberes y obligaciones que tiene como trabajador, los cuales se encuentran estipulados en el reglamento de PALMAS OLEAGINOSAS BUCARELIA S.A.S., el perfil del cargo, su contrato laboral. Hechos que se describieron en la citación a la Diligencia de Descargos, de la cual fue notificado al colaborador el {{ $fecha_actual }}, cumpliendo así con el tiempo que, según el procedimiento debe transcurrir entre la notificación y la Audiencia.</p>

        <p class="mt-4">Se le ofreció al trabajador citado la opción de estar acompañado en esta diligencia por un compañero de trabajo, para que actúe como testigo de la misma condición, expresa que viene acompañado de los representantes de la organización sindical.</p>

        <p class="mt-4">El trabajador citado a descargos refiere sus generales de ley así, Nombre: <span class="text-bold">{{ $proceso->nombre_trabajador }}</span>, mayor de edad, identificado con la cédula de ciudadanía número <span class="text-bold">{{ $proceso->numero_documento_trabajador }}</span> residente en <span class="text-underline">{{ $descargo->direccion_trabajador ?? '[DIRECCIÓN]' }}</span>, celular <span class="text-underline">{{ $descargo->telefono_trabajador ?? '[TELÉFONO]' }}</span>, funciones que desempeña actualmente son las relacionadas al cargo de {{ $proceso->labor ?? '[CARGO]' }}.</p>

        <p class="mt-4">Como secretaria actúa Nancy Elena Romero Narvaez, quien enterada manifiesta su aceptación.</p>

        <p class="mt-4">Se exhorta al citado, para que dé respuesta en forma concreta y clara a cada uno de los interrogantes que se le efectuarán en el curso de la Diligencia de Descargos y se le solicita hablar en forma pausada para que sus respuestas y comentarios sean consignados en el Acta de la Diligencia fielmente.</p>

        <div class="title mt-4">INTERROGATORIO</div>

        @for($i = 1; $i <= 19; $i++)
            <p class="mt-3 text-bold">{{ $i }}. {{ $preguntas[$i] }}</p>
            <p class="mt-1">{{ $descargo->{'respuesta_'.$i} ?? '[RESPUESTA]' }}</p>
        @endfor
        <div class="title mt-4">Comentarios Finales </div>

        <div >               
                <p>{{ $descargo->comentarios ?? 'sin comentarios finales' }}</p>
        </div><br><br><br>
        <div class="title mt-4">FIRMAS</div>

        <div class="mt-4">
            <div class="firma">
                <p>Trabajador en descargos</p>
                <p>{{ $descargo->firma_implicado ?? '[NOMBRE]' }}</p>
            </div>

            <div class="firma">
                <p>Representante Sintrainagro</p>
                <p>RAFAEL E. OLIVEROS DAVILA</p>
            </div>

            <div class="firma">
                <p>Directora de Gestión Humana</p>
                <p>NANCY ELENA ROMERO NARVAEZ</p>
            </div>
        </div>
    </div>
    <footer>
        <img src="{{ public_path('images/footer_llamado.png') }}" style="width: 100%;">
    </footer>
</body>
</html>