<?php

namespace App\Exports;

use App\Models\Local;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LocalesExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    /**
    * Obtiene todos los locales junto con su vendedor
    */
    public function collection()
    {
        return Local::with('vendedor')->get();
    }

    /**
    * Define los encabezados de las columnas en el Excel
    */
    public function headings(): array
    {
        return [
            'ID',
            'Nombre del Negocio',
            'Categoría',
            'Ubicación',
            'Vendedor Encargado',
            'Teléfono Vendedor',
            'Visitas',
            'Fecha de Registro',
        ];
    }

    /**
    * Mapea los datos de cada fila
    */
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
            // --- CAMBIA ESTA LÍNEA ---
            // En lugar de: $local->created_at->format('d/m/Y'),
            // Usa esto:
            \Carbon\Carbon::parse($local->created_at)->format('d/m/Y'),
        ];
    }
    /**
    * Estilos opcionales (negritas en encabezado)
    */
    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}