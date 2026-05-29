<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendedor;
use Illuminate\Support\Facades\Storage;

class VendedorController extends Controller
{
    public function index()
    {
        $vendedores = Vendedor::all();
        return view('vendedores.index', compact('vendedores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'telefono' => 'nullable',
            'email' => 'nullable|email',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $datos = $request->except('foto');

        // Subir Foto si existe
        if ($request->hasFile('foto')) {
            $datos['foto'] = $request->file('foto')->store('uploads', 'public');
        }

        Vendedor::create($datos);

        return redirect()->route('vendedores.index')->with('success', 'Vendedor registrado correctamente.');
    }

    public function destroy($id)
    {
        $vendedor = Vendedor::findOrFail($id);
        $vendedor->delete();
        return back()->with('success', 'Vendedor eliminado.');
    }
}