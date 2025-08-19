<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\EntidadCesantias;

class CesantiasController extends Controller
{public function index()
    {
        $cesantias = EntidadCesantias::all();
        return view('cesantia.index', compact('cesantias'));
    }

    public function create()
    {
        return view('cesantia.create');
    }

    public function store(Request $request)
    {
        EntidadCesantias::create($request->validate([
            'codigo' => 'required|unique:banco|max:10',
            'nombre' => 'required|string|max:255',
        ]));
        return redirect()->route('cesantia.index');
    }

    public function edit(EntidadCesantias $cesantium)
    {
        return view('cesantia.edit', compact('cesantium'));
    }
    
    public function update(Request $request, EntidadCesantias $cesantium)
    {
        $cesantium->update($request->validate([
            'codigo' => 'required|max:10',
            'nombre' => 'required|string|max:255',
        ]));
        return redirect()->route('cesantia.index');
    }
    

    public function destroy(EntidadCesantias $cesantias)
    {
        $cesantias->delete();
        return redirect()->route('cesantia.index');
    }
}
