@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h4 class="text-center fw-bold">OTRO SÍ AL CONTRATO DE TRABAJO</h4>
            <p class="text-justify mt-4">
                Entre los suscritos a saber; <strong>NANCY ELENA ROMERO NARVAEZ</strong>, identificada con la cédula de ciudadanía número 1.104.124.627 expedida en Puerto Wilches, quien obra en nombre de la empresa <strong>PALMAS OLEAGINOSAS BUCARELIA S.A.S.</strong>, que en adelante se llamará el <strong>EMPLEADOR</strong>, y por otra parte <strong>{{ $empleado->nombre }}</strong> identificado con cédula de ciudadanía número <strong>{{ $empleado->documento }}</strong>, quien obra en nombre propio y se denominará <strong>EL TRABAJADOR</strong>, manifestamos que:
            </p>
            <p class="mt-3">
                PRIMERA: El presente contrato de trabajo se prorrogará por un período de <strong>{{ $revision->periodo_renovacion ?? 'Tres (03) Meses' }}</strong>, contados a partir del día <strong>{{ \Carbon\Carbon::parse($revision->fecha_renovacion)->format('d \d\e F \d\e Y') }}</strong>. (Prórroga {{ $revision->numero_prorrogas ?? '1' }}).
            </p>
            <p class="mt-4">
                En lo demás, las partes ratifican el contrato inicial. Se firma en Puerto Wilches, el <strong>{{ now()->format('d \d\e F \d\e Y') }}</strong>.
            </p>

            <div class="row text-center mt-5">
                <div class="col-md-6">
                    <p>_____________________________<br><strong>NANCY ELENA ROMERO NARVAEZ</strong><br>EL EMPLEADOR<br>C.C. 1.104.124.627</p>
                </div>
                <div class="col-md-6">
                    <p>_____________________________<br><strong>{{ $empleado->nombre }}</strong><br>EL TRABAJADOR<br>C.C. {{ $empleado->documento }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
