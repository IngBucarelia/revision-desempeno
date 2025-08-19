<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EntidadArp;


class ArpController extends Controller
{
    public function index()
    {
        $arps = EntidadArp::all();
        return view('arp.index', compact('arps'));
    }

    public function create()
    {
        return view('arp.create');
    }

    public function store(Request $request)
    {
        EntidadArp::create($request->validate([
            'codigo' => 'required|unique:banco|max:10',
            'nombre' => 'required|string|max:255',
        ]));
        return redirect()->route('arp.index');
    }

    public function edit(EntidadArp $arp)
    {
        return view('arp.edit', compact('arp'));
    }
    
    public function update(Request $request, EntidadArp $arp)
    {
        $arp->update($request->validate([
            'codigo' => 'required|max:10',
            'nombre' => 'required|string|max:255',
        ]));
        return redirect()->route('arp.index');
    }
    

    public function destroy(EntidadArp $arp)
    {
        $arp->delete();
        return redirect()->route('arp.index');
    }
}
