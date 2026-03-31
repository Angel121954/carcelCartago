<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <style>
        body { font-family: Arial, sans-serif; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #000; padding: 6px; font-size: 12px; }
        th { background: #e5e7eb; }
    </style>
</head>
<body>
    <h2>{{ $title }}</h2>
    <p>{{ implode(' | ', $meta_lines) }}</p>
    <table>
        <thead>
            <tr>
                @foreach ($headers as $header)
                    <th>{{ $header }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @forelse ($visitas as $visita)
                <tr>
                    <td>{{ $visita->id }}</td>
                    <td>{{ $visita->prisionero?->nombre_completo }}</td>
                    <td>{{ $visita->visitante?->nombre_completo }}</td>
                    <td>{{ $visita->guardia?->nombre_completo }}</td>
                    <td>{{ $visita->fecha }}</td>
                    <td>{{ $visita->hora_inicio }}</td>
                    <td>{{ $visita->hora_fin }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">No hay registros para el rango seleccionado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
