<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        return view('productos.index', compact('productos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'cantidad' => 'required|integer|min:0',
            'precio_costo' => 'required|numeric',
            'precio_venta' => 'required|numeric',
        ]);

        Producto::create($request->all());

        return redirect()->route('productos.index')->with('success', 'Producto creado correctamente');
    }

    public function actualizarStock(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);
        $movimiento = $request->input('cantidad_movimiento'); 
        $nuevoStock = $producto->cantidad + $movimiento;

        if ($nuevoStock < 0) {
            return back()->with('error', 'No hay suficiente stock.');
        }

        $producto->cantidad = $nuevoStock;
        $producto->save();

        return back()->with('success', 'Stock actualizado.');
    }
}