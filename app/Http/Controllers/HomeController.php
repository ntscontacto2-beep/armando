<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Local;
use App\Models\Vendedor;
use App\Models\Ruta;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Local::with('vendedor')->orderBy('id', 'desc');

        if ($request->filled('categoria')) {
            $query->where('categoria', $request->categoria);
        }

        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('nombre', 'like', '%' . $request->q . '%')
                  ->orWhere('descripcion', 'like', '%' . $request->q . '%');
            });
        }

        $locales = $query->take(12)->get();

        $categorias = Local::select('categoria', DB::raw('count(*) as total'))
            ->groupBy('categoria')
            ->get();

        // --- Datos para gráficas ---
        $porCategoria = Local::select('categoria', DB::raw('count(*) as total'))
            ->groupBy('categoria')
            ->orderByDesc('total')
            ->get();

        $porDias = Local::select('dias_laborales', DB::raw('count(*) as total'))
            ->groupBy('dias_laborales')
            ->orderByDesc('total')
            ->get();

        $now     = Carbon::now();
        $abiertos = Local::whereNotNull('hora_apertura')
            ->whereNotNull('hora_cierre')
            ->get()
            ->filter(fn($l) => $now->between(
                Carbon::parse($l->hora_apertura),
                Carbon::parse($l->hora_cierre)
            ))->count();

        $totalLocales   = Local::count();
        $totalVendedores = Vendedor::count();
        $cerrados       = $totalLocales - $abiertos;

        return view('dashboard', compact(
            'locales', 'categorias',
            'porCategoria', 'porDias',
            'abiertos', 'cerrados',
            'totalLocales', 'totalVendedores'
        ));
    }

    public function historia()
    {
        return view('paginas.historia');
    }

    public function rutas()
    {
        $locales = Local::whereNotNull('latitud')
            ->whereNotNull('longitud')
            ->select('nombre', 'categoria', 'ubicacion', 'latitud', 'longitud')
            ->get();

        return view('paginas.rutas', [
            'locales'        => $locales,
            'googleMapsKey'  => env('GOOGLE_MAPS_API_KEY', ''),
            'openWeatherKey' => env('OPENWEATHER_API_KEY', ''),
        ]);
    }
}
