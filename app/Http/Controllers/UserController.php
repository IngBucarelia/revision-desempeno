<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;



class UserController extends Controller
{
    public function index()
    {
        $usuario = User::all(); 
        return view('usuarios.index', compact('usuario')); // Ajusta según tu vista
    }

    public function show($id)
    {
        $usuario = User::findOrFail($id);
        return view('usuarios.show', compact('usuario'));
    }

    // Formulario para editar usuario
    public function edit($id)
    {   $usuario = User::findOrFail($id);
        $roles = Role::all(); // Suponiendo que tienes una tabla 'roles'
        return view('usuarios.edit', compact('usuario', 'roles'));
        
    }

    // Actualizar usuario
    public function update(Request $request, $id)
    {


        
        $usuario = User::findOrFail($id);
        $usuario->update($request->all());

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente');
    }

    // Eliminar usuario
    public function destroy($id)
    {
        $usuario = User::findOrFail($id);
        $usuario->delete();

        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado correctamente');
    }
}
