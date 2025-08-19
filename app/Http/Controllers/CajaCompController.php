<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EntidadCajaComp;

class CajaCompController extends Controller
{
    public function index()
    {
        $cajacomps = EntidadCajaComp::all();
        return view('cajacomp.index', compact('cajacomps'));
    }

    public function create()
    {
        return view('cajacomp.create');
    }

    public function store(Request $request)
    {
        EntidadCajaComp::create($request->validate([
            'codigo' => 'required|unique:banco|max:10',
            'nombre' => 'required|string|max:255',
        ]));
        return redirect()->route('cajacomp.index');
    }

    public function edit(EntidadCajaComp $cajacomp)
    {
        return view('cajacomp.edit', compact('cajacomp'));
    }
    
    public function update(Request $request, EntidadCajaComp $cajacomp)
    {
        $cajacomp->update($request->validate([
            'codigo' => 'required|max:10',
            'nombre' => 'required|string|max:255',
        ]));
        return redirect()->route('cajacomp.index');
    }
    

    public function destroy(EntidadCajaComp $cajacomp)
    {
        $cajacomp->delete();
        return redirect()->route('cajacomp.index');
    }
}
