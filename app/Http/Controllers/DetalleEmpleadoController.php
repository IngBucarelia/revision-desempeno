<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
use App\Models\DetalleEmpleado;
use App\Models\EntidadPension;
use App\Models\EntidadEps;
use App\Models\EntidadCesantias;
use App\Models\EntidadCajaComp;
use App\Models\EntidadArp;
use App\Models\Banco;


class DetalleEmpleadoController extends Controller
{
    public function show($id)
    {
        $empleado = Empleado::findOrFail($id);
        return view('empleados.detalle', compact('empleado'));
    }

    public function store(Request $request, $id)
    {
        $empleado = Empleado::findOrFail($id);
        $detalle = new DetalleEmpleado($request->all());
        $empleado->detalle()->save($detalle);

        return redirect()->route('detalle_empleado.show', $id);
    }

    public function update(Request $request, $id)
    {
        $empleado = Empleado::findOrFail($id);
        $empleado->detalle()->update($request->all());

        return redirect()->route('detalle_empleado.show', $id)->with('success', 'Detalle actualizado correctamente');
    }

    
    public function actualizarDetalle(Request $request, $id)
    {
        $detalle = DetalleEmpleado::where('empleado_id', $id)->firstOrFail();
        $detalle->update($request->all());

        return redirect()->route('empleados.detalle', $id)->with('success', 'Detalles actualizados correctamente.');
    }


        public function mostrarDetalle($id)
    {
        $empleado = Empleado::findOrFail($id);
        $detalle = DetalleEmpleado::with(['pension', 'eps', 'cesantias', 'cajaComp', 'arp'])
                    ->where('empleado_id', $id)
                    ->first();

        return view('empleados.detalle', compact('empleado', 'detalle'));
    }

    public function editarDetalle($id)
    {
        $empleado = Empleado::findOrFail($id);
        $detalle = DetalleEmpleado::with(['pension', 'eps', 'cesantias', 'cajaComp', 'arp','banco'])
                    ->where('empleado_id', $id)
                    ->first();

        // Obtener todas las entidades para el select en la vista de edición
        $pensiones = EntidadPension::all();
        $eps = EntidadEps::all();
        $cesantias = EntidadCesantias::all();
        $cajas = EntidadCajaComp::all();
        $arps = EntidadArp::all();
        $banco = banco::all();

        return view('empleados.editar_detalle', compact('empleado', 'detalle', 'pensiones', 'eps', 'cesantias', 'cajas', 'arps','banco'));
    }
}
