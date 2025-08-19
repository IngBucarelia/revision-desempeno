<x-app-layout>
    <x-appbar />




<link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/css_dascboard.css') }}">

    <div class="contenedor-principal">
        <x-sidebar />

        <div class="contenido">    
            <div class="container">

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

             <div class="contenido">
                <form action="{{ route('empleados.detalle.actualizar', $empleado->id) }}" method="POST">
                    @csrf
                    @method('PUT')
    
                    <div class="row">
                        

                        <div class="seccion">
                            <h3 class="titulo-seccion">Datos Financieros</h3>
                            <label>Cuenta Bancaria:</label>
                            <input type="text" name="cuenta_bancaria"  value="{{ $detalle->cuenta_bancaria ?? 'No disponible' }}" required>
                
                            <label>Banco:</label>
                            <select name="id_banco">
                                @foreach($banco as $bancos)
                                    <option value="{{ $bancos->id }}" 
                                        {{ $detalle?->id_entidad_banco == $bancos->id ? 'selected' : '' }}>
                                        {{ $bancos->nombre ?? 'No disponible' }}
                                    </option>
                                @endforeach
                            </select>
                            <input type="text" name="id_banco" value="{{ $detalle->id_banco ?? 'No disponible'  }}" required>
                
                            <label>Forma de Pago:</label>
                            <select name="indicador_forma_pago" required>
                                <option value="transferencia" {{ $detalle?->indicador_forma_pago == 'transferencia' ? 'selected' : '' }}>Transferencia</option>
                                <option value="cheque" {{ $detalle?->indicador_forma_pago == 'cheque' ? 'selected' : '' }}>Cheque</option>
                                <option value="efectivo" {{ $detalle?->indicador_forma_pago == 'efectivo' ? 'selected' : '' }}>Efectivo</option>
                            </select>
                        </div>

                        
                
    
                        

                         <!-- Sección: Datos Personales -->
                        <div class="seccion">
                            <h3 class="titulo-seccion">Datos Personales</h3>
                            <label>Dirección:</label>
                            <input type="text" name="direccion" value="{{ $detalle->direccion ?? 'No disponible'  }}" required>
    
                            <label>Fecha de Nacimiento:</label>
                            <input type="date" name="fecha_nacimiento" value="{{ $detalle->fecha_nacimiento ?? 'No disponible'  }}" required>
    
                            <label>Lugar de Nacimiento:</label>
                            <input type="text" name="lugar_nacimiento" value="{{ $detalle->lugar_nacimiento ?? 'No disponible'  }}" required>
    
                            <label>Talla de Camisa:</label>
                            <input type="text" name="camisa" value="{{ $detalle->camisa ?? 'No disponible' }}" required>
    
                            <label>Talla de Pantalón:</label>
                            <input type="text" name="pantalon" value="{{ $detalle->pantalon ?? 'No disponible' }}" required>
    
                            <label>Talla de Zapatos:</label>
                            <input type="text" name="zapatos" value="{{ $detalle->zapatos ?? 'No disponible'  }}" required>
                     
                        </div>
                
    
                      

                        <div class="seccion">
                            <h3 class="titulo-seccion">Datos de Salud y Pagos</h3>
                            <label>Entidad de Pensión:</label>
                                <select name="id_entidad_pension">
                                    @foreach($pensiones as $pension)
                                        <option value="{{ $pension->id }}" 
                                            {{ $detalle?->id_entidad_pension == $pension->id ? 'selected' : '' }}>
                                            {{ $pension->nombre ?? 'No disponible' }}
                                        </option>
                                    @endforeach
                                </select>

                        
                                <label>Entidad EPS:</label>
                                <select name="id_entidad_eps">
                                    @foreach($eps as $entidad)
                                        <option value="{{ $entidad->id }}" 
                                            {{ $detalle?->id_entidad_eps == $entidad->id ? 'selected' : '' }}>
                                            {{ $entidad->nombre ?? 'No disponible' }}
                                        </option>
                                    @endforeach
                                </select>
                                
                        
                                <label>Entidad de Cesantías:</label>
                                <select name="id_entidad_cesantias">
                                    @foreach($cesantias as $cesantia)
                                        <option value="{{ $cesantia->id }}" 
                                            {{ $detalle?->id_entidad_cesantias == $cesantia->id ? 'selected' : '' }}>
                                            {{ $cesantia->nombre ?? 'No disponible' }}
                                        </option>
                                    @endforeach
                                </select>
                                
                        
                                <label>Caja de Compensación:</label>
                                <select name="id_entidad_caja_comp">
                                    @foreach($cajas as $caja)
                                        <option value="{{ $caja->id }}" 
                                            {{ $detalle?->id_entidad_caja_comp == $caja->id ? 'selected' : '' }}>
                                            {{ $caja->nombre ?? 'No disponible' }}
                                        </option>
                                    @endforeach
                                </select>
                                
                                <label>ARP:</label>
                                <select name="id_entidad_arp">
                                    @foreach($arps as $arp)
                                        <option value="{{ $arp->id }}" 
                                            {{ $detalle?->id_entidad_arp == $arp->id ? 'selected' : '' }}>
                                            {{ $arp->nombre ?? 'No disponible' }}
                                        </option>
                                    @endforeach
                                </select>
                        </div>

                        <div class="seccion">
                            <h3 class="titulo-seccion">Fechas Laborales</h3>
                            <label>Fecha de Ingreso Ley 50:</label>
                            <input type="date" name="fecha_ingreso_ley50" value="{{ $detalle->fecha_ingreso_ley50 ?? 'No disponible'  }}" required>
                
                            <label>Fecha Prima Hasta:</label>
                            <input type="date" name="fecha_prima_hasta" value="{{ $detalle->fecha_prima_hasta ?? 'No disponible'  }}" required>
                
                            <label>Fecha Vacaciones Hasta:</label>
                            <input type="date" name="fecha_vacaciones_hasta" value="{{ $detalle->fecha_vacaciones_hasta ?? 'No disponible'  }}" required>
                
                            <label>Fecha Último Aumento:</label>
                            <input type="date" name="fecha_ultimo_aumento" value="{{ $detalle->fecha_ultimo_aumento ?? 'No disponible'  }}" required>
                
                            <label>Fecha Últimas Vacaciones:</label>
                            <input type="date" name="fecha_ultimas_vacaciones" value="{{ $detalle->fecha_ultimas_vacaciones ?? 'No disponible'  }}" required>
                
                            <label>Fecha Última Pensión:</label>
                            <input type="date" name="fecha_ultima_pension" value="{{ $detalle->fecha_ultima_pension ?? 'No disponible'  }}" required>
                        </div>
                        
                    </div>
    
                    <button type="submit" class="btn btn-success mt-3">Guardar Cambios</button><br>
                    
                </form>
                <button class="btn btn-warning btn-sm" onclick="window.location='{{ url()->previous() }}'" style="margin-bottom: 5px !important; background:#ab4d1a;">
                    <i class="fas fa-edit"></i> Cancelar
                </button><br>
            </div>
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

