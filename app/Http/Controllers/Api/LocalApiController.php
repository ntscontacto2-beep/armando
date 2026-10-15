<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Local;
use App\Models\Vendedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LocalApiController extends Controller
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

        $locales = $query->paginate(12);

        return response()->json($locales);
    }

    public function categorias()
    {
        $categorias = Local::select('categoria', DB::raw('count(*) as total'))
            ->groupBy('categoria')
            ->orderByDesc('total')
            ->get();

        return response()->json($categorias);
    }

    public function rutas()
    {
        $locales = Local::whereNotNull('latitud')
            ->whereNotNull('longitud')
            ->select('id', 'nombre', 'categoria', 'ubicacion', 'latitud', 'longitud', 'hora_apertura', 'hora_cierre')
            ->orderBy('nombre')
            ->get();

        return response()->json($locales);
    }

    public function dashboard()
    {
        $now = Carbon::now();

        $abiertos = Local::whereNotNull('hora_apertura')
            ->whereNotNull('hora_cierre')
            ->get()
            ->filter(fn($l) => $now->between(
                Carbon::parse($l->hora_apertura),
                Carbon::parse($l->hora_cierre)
            ))->count();

        $totalLocales    = Local::count();
        $totalVendedores = Vendedor::count();

        $porCategoria = Local::select('categoria', DB::raw('count(*) as total'))
            ->groupBy('categoria')
            ->orderByDesc('total')
            ->get();

        return response()->json([
            'total_locales'    => $totalLocales,
            'total_vendedores' => $totalVendedores,
            'abiertos'         => $abiertos,
            'cerrados'         => $totalLocales - $abiertos,
            'por_categoria'    => $porCategoria,
        ]);
    }
}
