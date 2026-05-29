<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte de Locales</title>
</head>
<body>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; font-size: 10px; }
        th { background-color: #f2f2f2; }
    </style>

    <h1>Reporte de Locales del Tianguis SMT</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre del Local</th>
                <th>Categoría</th>
                <th>Ubicación</th>
                <th>Vendedor Responsable</th> 
                <th>Descripción</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($locales as $local)
                <tr>
                    <td>{{ $local->id }}</td>
                    <td>{{ $local->nombre }}</td>
                    <td>{{ $local->categoria }}</td>
                    <td>{{ $local->ubicacion }}</td>
                    {{-- CORRECCIÓN AQUÍ: Usamos la relación ->vendedor->nombre --}}
                    <td>{{ $local->vendedor->nombre ?? 'N/A' }}</td>
                    <td>{{ $local->descripcion }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>