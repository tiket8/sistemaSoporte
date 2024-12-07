<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'rol' => 'required|in:admin,soporte,cliente',
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'rol' => $request->rol,
        ]);

        return redirect()->route('users.index')->with('success', 'Usuario actualizado correctamente.');
    }

    public function activate($id)
    {
        $user = User::findOrFail($id);
        $user->update(['estado' => true]);

        return redirect()->route('users.index')->with('success', 'Usuario activado correctamente.');
    }

    public function deactivate($id)
    {
        $user = User::findOrFail($id);
        $user->update(['estado' => false]);

        return redirect()->route('users.index')->with('success', 'Usuario desactivado correctamente.');
    }
}
