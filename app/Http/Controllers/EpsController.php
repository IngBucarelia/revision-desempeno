<?php

namespace App\Http\Controllers;
use App\Models\EntidadEps;


use Illuminate\Http\Request;

class EpsController extends Controller
{
    public function index()
    {
        $epss = EntidadEps::all();
        return view('eps.index', compact('epss'));
    }

    public function create()
    {
        return view('eps.create');
    }

    public function store(Request $request)
    {
        EntidadEps::create($request->validate([
            'codigo' => 'required|unique:banco|max:10',
            'nombre' => 'required|string|max:255',
        ]));
        return redirect()->route('eps.index');
    }

    public function edit(EntidadEps $eps)
    {
        return view('eps.edit', compact('eps'));
    }
    
    public function update(Request $request, EntidadEps $eps)
    {
        $eps->update($request->validate([
            'codigo' => 'required|max:10',
            'nombre' => 'required|string|max:255',
        ]));
        return redirect()->route('eps.index');
    }
    

    public function destroy(EntidadEps $eps)
    {
        $eps->delete();
        return redirect()->route('eps.index');
    }
}
