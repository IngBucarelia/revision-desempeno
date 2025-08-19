<?php

// app/Http/Controllers/ClaseFaltaController.php
namespace App\Http\Controllers;

use App\Models\ClaseFalta;
use Illuminate\Http\Request;

class ClaseFaltaController extends Controller
{
    public function index()
    {
        $clases = ClaseFalta::all();
        return view('clases_faltas.index', compact('clases'));
    }

    public function create()
    {
        return view('clases_faltas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|unique:clases_faltas,nombre'
        ]);

        ClaseFalta::create($request->only('nombre'));

        return redirect()->route('clases_faltas.index')->with('success', 'Clase de falta creada correctamente.');
    }

    public function edit(ClaseFalta $clases_falta)
    {
        return view('clases_faltas.edit', compact('clases_falta'));
    }

    public function update(Request $request, ClaseFalta $clases_falta)
    {
        $request->validate([
            'nombre' => 'required|string|unique:clases_faltas,nombre,' . $clases_falta->id,
        ]);

        $clases_falta->update($request->only('nombre'));

        return redirect()->route('clases_faltas.index')->with('success', 'Clase de falta actualizada correctamente.');
    }

    public function destroy(ClaseFalta $clases_falta)
    {
        $clases_falta->delete();
        return redirect()->route('clases_faltas.index')->with('success', 'Clase de falta eliminada.');
    }
}
