<x-app-layout>
    <x-appbar />




<link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css_dascboard.css') }}">

    <div class="contenedor-principal">
        <x-sidebar />

        <div class="contenido">    
            <div class="container">
            <h2>Registrar Nuevo Empleado</h2>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('empleados.detalle.guardar', $empleado->id) }}" method="POST">
                @csrf
        
                <!-- Sección: Datos Financieros -->
                <div class="seccion">
                    <h3 class="titulo-seccion">Datos Financieros</h3>
                    <label>Cuenta Bancaria:</label>
                    <input type="text" name="cuenta_bancaria" required>
        
                    <label>Banco:</label>
                    <select name="id_banco" required>
                        <option value="">Seleccione un banco</option>
                        @foreach($bancos as $banco)
                            <option value="{{ $banco->id }}">{{ $banco->nombre }}</option>
                        @endforeach
                    </select>
        
                    <label>Forma de Pago:</label>
                    <select name="indicador_forma_pago" required>
                        <option value="transferencia">Transferencia</option>
                        <option value="cheque">Cheque</option>
                        <option value="efectivo">Efectivo</option>
                    </select>
                </div>
        
                <!-- Sección: Datos Personales -->
                <div class="seccion">
                    <h3 class="titulo-seccion">Datos Personales</h3>
                    <label>Dirección:</label>
                    <input type="text" name="direccion" required>
        
                    <label>Fecha de Nacimiento:</label>
                    <input type="date" name="fecha_nacimiento" required>
        
                    <label>Lugar de Nacimiento:</label>
                    <input type="text" name="lugar_nacimiento" required>
        
                    <label>Talla de Camisa:</label>
                    <input type="text" name="camisa" required>
        
                    <label>Talla de Pantalón:</label>
                    <input type="text" name="pantalon" required>
        
                    <label>Talla de Zapatos:</label>
                    <input type="text" name="zapatos" required>
                </div>
        
                <!-- Sección: Datos de Salud -->
                <div class="seccion">
                    <h3 class="titulo-seccion">Datos de Salud y Pagos</h3>
                    <label>Entidad de Pensión:</label>
                    <select name="id_entidad_pension" required>
                        <option value="">Seleccione una entidad</option>
                        @foreach($pensiones as $pension)
                            <option value="{{ $pension->id }}">{{ $pension->nombre }}</option>
                        @endforeach
                    </select>
                    
                    <label>Entidad EPS:</label>
                    <select name="id_entidad_eps" required>
                        <option value="">Seleccione una EPS</option>
                        @foreach($eps as $entidad)
                            <option value="{{ $entidad->id }}">{{ $entidad->nombre }}</option>
                        @endforeach
                    </select>
                    
                    <label>Entidad de Cesantías:</label>
                    <select name="id_entidad_cesantias" required>
                        <option value="">Seleccione una entidad</option>
                        @foreach($cesantias as $cesantia)
                            <option value="{{ $cesantia->id }}">{{ $cesantia->nombre }}</option>
                        @endforeach
                    </select>
                    
                    <label>Caja de Compensación:</label>
                    <select name="id_entidad_caja_comp" required>
                        <option value="">Seleccione una caja</option>
                        @foreach($cajas as $caja)
                            <option value="{{ $caja->id }}">{{ $caja->nombre }}</option>
                        @endforeach
                    </select>
                    
                    <label>ARP:</label>
                    <select name="id_entidad_arp" required>
                        <option value="">Seleccione una ARP</option>
                        @foreach($arps as $arp)
                            <option value="{{ $arp->id }}">{{ $arp->nombre }}</option>
                        @endforeach
                    </select>
                </div>
        
                <!-- Sección: Fechas Laborales -->
                <div class="seccion">
                    <h3 class="titulo-seccion">Fechas Laborales</h3>
                    <label>Fecha de Ingreso Ley 50:</label>
                    <input type="date" name="fecha_ingreso_ley50" required>
        
                    <label>Fecha Prima Hasta:</label>
                    <input type="date" name="fecha_prima_hasta" required>
        
                    <label>Fecha Vacaciones Hasta:</label>
                    <input type="date" name="fecha_vacaciones_hasta" required>
        
                    <label>Fecha Último Aumento:</label>
                    <input type="date" name="fecha_ultimo_aumento" required>
        
                    <label>Fecha Últimas Vacaciones:</label>
                    <input type="date" name="fecha_ultimas_vacaciones" required>
        
                    <label>Fecha Última Pensión:</label>
                    <input type="date" name="fecha_ultima_pension" required>
                </div>
        
                <!-- Botón Guardar -->
                <div class="boton-guardar">
                    <button type="submit">Guardar</button>
                </div>
            </form><br><br>
            <button class="btn btn-warning btn-sm" onclick="window.location='{{ url()->previous() }}'" style="margin-bottom: 5px !important; background:#ab4d1a;">
                <i class="fas fa-edit"></i> Cancelar
            </button><br>
</div>
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

