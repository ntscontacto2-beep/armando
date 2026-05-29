<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Local;
use App\Models\Vendedor;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LocalesExport;

class LocalController extends Controller
{
    // --- CREAR (VISTA) ---
    public function create()
    {
        $vendedores = Vendedor::all();
        return view('locales.create', [
            'vendedores'     => $vendedores,
            'googleMapsKey'  => env('GOOGLE_MAPS_API_KEY', ''),
        ]);
    }

    // --- GUARDAR (LÓGICA) ---
    public function store(Request $request)
    {
        // 1. Validamos todos los campos, incluyendo los nuevos horarios
        $request->validate([
            'nombre' => 'required',
            'categoria' => 'required',
            'ubicacion' => 'required',
            'vendedor_id' => 'required',
            'dias_laborales' => 'required', // Nuevo
            'hora_apertura' => 'required',  // Nuevo
            'hora_cierre' => 'required',    // Nuevo
        ]);

        // 2. Guardamos en la base de datos
        Local::create([
        'nombre' => $request->nombre,
        'slug' => Str::slug($request->nombre) . '-' . rand(100, 999),
        'categoria' => $request->categoria,
        'ubicacion' => $request->ubicacion,
        'descripcion' => $request->descripcion,
        'vendedor_id' => $request->vendedor_id,
        'dias_laborales' => $request->dias_laborales,
        'hora_apertura' => $request->hora_apertura,
        'hora_cierre' => $request->hora_cierre,
        // Guardamos coordenadas
        'latitud' => $request->latitud,
        'longitud' => $request->longitud,
        'visitas' => 0
    ]);

        return redirect()->route('dashboard')
            ->with('success', 'Negocio registrado con sus horarios correctamente.');
    }

    public function map($local): array
    {
        return [
            $local->id,
            $local->nombre,
            $local->categoria,
            $local->ubicacion,
            $local->vendedor?->nombre ?? 'Sin asignar', 
            $local->vendedor?->telefono ?? 'N/A',
            $local->visitas,
            \Carbon\Carbon::parse($local->created_at)->format('d/m/Y'),
        ];
    }

    // --- EDITAR (VISTA) ---
    public function edit($id)
    {
        $local = Local::findOrFail($id);
        $vendedores = Vendedor::all();
        return view('locales.edit', compact('local', 'vendedores'));
    }

    // --- ACTUALIZAR (LÓGICA) ---
    public function update(Request $request, $id)
    {
        // 1. Validamos también al editar
 
{
    $request->validate([
        'nombre' => 'required',
        'categoria' => 'required',
        'ubicacion' => 'required',
        'dias_laborales' => 'required',
        'hora_apertura' => 'required',
        'hora_cierre' => 'required',
        'latitud' => 'nullable|numeric',  // Nuevo
        'longitud' => 'nullable|numeric', // Nuevo
    ]);
    
    $local = Local::findOrFail($id);
    
    $local->update([
        'nombre' => $request->nombre,
        'categoria' => $request->categoria,
        'ubicacion' => $request->ubicacion,
        'descripcion' => $request->descripcion,
        'vendedor_id' => $request->vendedor_id,
        'dias_laborales' => $request->dias_laborales,
        'hora_apertura' => $request->hora_apertura,
        'hora_cierre' => $request->hora_cierre,
        // Actualizamos coordenadas
        'latitud' => $request->latitud,
        'longitud' => $request->longitud,
    ]);

    return redirect()->route('dashboard')
        ->with('success', 'Negocio actualizado correctamente.');
}
    }
    // --- ELIMINAR ---
    public function destroy($id)
    {
        $local = Local::findOrFail($id);
        $local->delete();

        return redirect()->route('dashboard')->with('success', 'Negocio eliminado del sistema.');
    }

    // --- GENERAR PDF ---
    public function generarPDF()
    {
        $locales = Local::with('vendedor')->get();
        $pdf = Pdf::loadView('pdf.locales_tabla', ['locales' => $locales]);
        return $pdf->stream('reporte_locales_con_vendedor.pdf');
    }

    // --- GENERAR EXCEL ---
    public function generarExcel()
    {
        return Excel::download(new LocalesExport, 'reporte_locales.xlsx');
    }
}   