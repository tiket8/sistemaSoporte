<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function activateUser($id, Request $request)
{
    $user = User::findOrFail($id);
    $user->estado = true; // Activa el usuario
    $user->rol = $request->rol; // Asigna el rol
    $user->save();

    return redirect()->route('admin.users')->with('success', 'Usuario activado y rol asignado correctamente.');
}

}

