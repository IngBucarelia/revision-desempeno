<?php

namespace App\Http\Controllers;

use App\Models\TipoFalta;
use Illuminate\Http\Request;

class TipoFaltaController extends Controller
{
    public function index()
    {
        $tipos = TipoFalta::all();
        return view('tipo_faltas.index', compact('tipos'));
    }

    public function create()
    {
        return view('tipo_faltas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|unique:tipo_faltas,nombre|max:255'
        ]);

        TipoFalta::create($request->all());

        return redirect()->route('tipo_faltas.index')->with('success', 'Tipo de falta creado correctamente.');
    }

    public function edit(TipoFalta $tipo_falta)
    {
        return view('tipo_faltas.edit', compact('tipo_falta'));
    }

    public function update(Request $request, TipoFalta $tipo_falta)
    {
        $request->validate([
            'nombre' => 'required|max:255|unique:tipo_faltas,nombre,' . $tipo_falta->id,
        ]);

        $tipo_falta->update($request->all());

        return redirect()->route('tipo_faltas.index')->with('success', 'Tipo de falta actualizado.');
    }

    public function destroy(TipoFalta $tipo_falta)
    {
        $tipo_falta->delete();
        return redirect()->route('tipo_faltas.index')->with('success', 'Tipo de falta eliminado.');
    }
}
