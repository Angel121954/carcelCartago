<?php

namespace App\Http\Controllers;

use App\Models\Prisionero;
use App\Models\Visita;
use App\Support\SimplePdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class ReporteController extends Controller
{
    public function index(Request $request): View
    {
        return view('reportes.index', $this->buildReportData($request));
    }

    public function pdf(Request $request)
    {
        $data = $this->buildReportData($request);

        return response(SimplePdf::fromRows(
            $data['title'],
            $data['meta_lines'],
            $data['headers'],
            $data['pdf_rows']
        ), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="'.$data['filename'].'.pdf"',
        ]);
    }

    public function excel(Request $request)
    {
        $data = $this->buildReportData($request);

        return response(view('reportes.excel', $data)->render(), 200, [
            'Content-Type' => 'application/vnd.ms-excel; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="'.$data['filename'].'.xls"',
        ]);
    }

    private function buildReportData(Request $request): array
    {
        $validated = Validator::make($request->query(), [
            'fecha_inicio' => ['nullable', 'date'],
            'fecha_fin' => ['nullable', 'date', 'after_or_equal:fecha_inicio'],
            'prisionero_id' => ['nullable', 'integer', 'exists:prisioneros,id'],
        ])->validate();

        $fechaInicio = Carbon::parse($validated['fecha_inicio'] ?? now()->startOfMonth())->startOfDay();
        $fechaFin = Carbon::parse($validated['fecha_fin'] ?? now())->endOfDay();
        $prisioneroId = $validated['prisionero_id'] ?? null;

        $query = Visita::with(['prisionero', 'visitante', 'guardia'])
            ->whereBetween('fecha', [$fechaInicio->toDateString(), $fechaFin->toDateString()])
            ->orderBy('fecha')
            ->orderBy('hora_inicio');

        if ($prisioneroId) {
            $query->where('prisionero_id', $prisioneroId);
        }

        $visitas = $query->get();
        $prisioneros = Prisionero::orderBy('nombre_completo')->get();

        $pdfRows = $visitas->map(fn (Visita $visita) => [
            (string) $visita->id,
            $visita->prisionero?->nombre_completo ?? '-',
            $visita->visitante?->nombre_completo ?? '-',
            $visita->guardia?->nombre_completo ?? '-',
            Carbon::parse($visita->fecha)->format('d/m/Y'),
            substr((string) $visita->hora_inicio, 0, 5),
            substr((string) $visita->hora_fin, 0, 5),
        ])->all();

        $title = $prisioneroId ? 'Historial de visitas por prisionero' : 'Reporte de visitas de prisioneros y visitantes';
        $filename = $prisioneroId ? 'historial_visitas_prisionero_'.$prisioneroId : 'reporte_visitas_general';

        $metaLines = [
            'Rango: '.$fechaInicio->format('d/m/Y').' al '.$fechaFin->format('d/m/Y'),
            'Total visitas: '.$visitas->count(),
        ];

        if ($prisioneroId) {
            $metaLines[] = 'Prisionero: '.optional($prisioneros->firstWhere('id', (int) $prisioneroId))->nombre_completo;
        }

        return [
            'title' => $title,
            'filename' => $filename,
            'meta_lines' => $metaLines,
            'headers' => ['ID', 'Prisionero', 'Visitante', 'Guardia', 'Fecha', 'Inicio', 'Fin'],
            'visitas' => $visitas,
            'prisioneros' => $prisioneros,
            'filters' => [
                'fecha_inicio' => $fechaInicio->toDateString(),
                'fecha_fin' => $fechaFin->toDateString(),
                'prisionero_id' => $prisioneroId,
            ],
            'summary' => [
                'visitas' => $visitas->count(),
                'prisioneros' => $visitas->pluck('prisionero_id')->unique()->count(),
                'visitantes' => $visitas->pluck('visitante_id')->unique()->count(),
            ],
            'pdf_rows' => $pdfRows,
        ];
    }
}
