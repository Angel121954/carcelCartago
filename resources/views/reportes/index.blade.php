<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Informes') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form method="GET" action="{{ route('admin.reportes.index') }}" class="space-y-6">
                    <div class="grid gap-4 md:grid-cols-3">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Fecha inicio</label>
                            <input type="date" name="fecha_inicio" value="{{ $filters['fecha_inicio'] }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Fecha fin</label>
                            <input type="date" name="fecha_fin" value="{{ $filters['fecha_fin'] }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Prisionero</label>
                            <select name="prisionero_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Todos</option>
                                @foreach ($prisioneros as $prisionero)
                                    <option value="{{ $prisionero->id }}" @selected((string) $filters['prisionero_id'] === (string) $prisionero->id)>
                                        {{ $prisionero->nombre_completo }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div style="margin-top:20px; display:grid; grid-template-columns:repeat(2, minmax(0, 1fr)); gap:10px; width:100%;">
                        <button type="submit" style="display:block; width:100%; background:#4f46e5; color:#fff; border:0; border-radius:8px; padding:10px 14px; font-weight:600; cursor:pointer;">Aplicar filtros</button>
                        <a href="{{ route('admin.reportes.pdf.view', request()->query()) }}" target="_blank" style="display:block; width:100%; text-align:center; background:#b91c1c; color:#fff; border:1px solid #b91c1c; border-radius:8px; padding:10px 14px; font-weight:600; text-decoration:none;">Ver PDF</a>
                        <a href="{{ route('admin.reportes.pdf', request()->query()) }}" style="display:block; width:100%; text-align:center; background:#dc2626; color:#fff; border:1px solid #dc2626; border-radius:8px; padding:10px 14px; font-weight:600; text-decoration:none;">Descargar PDF</a>
                        <a href="{{ route('admin.reportes.excel.view', request()->query()) }}" target="_blank" style="display:block; width:100%; text-align:center; background:#15803d; color:#fff; border:1px solid #15803d; border-radius:8px; padding:10px 14px; font-weight:600; text-decoration:none;">Ver Excel</a>
                        <a href="{{ route('admin.reportes.excel', request()->query()) }}" style="display:block; width:100%; text-align:center; background:#16a34a; color:#fff; border:1px solid #15803d; border-radius:8px; padding:10px 14px; font-weight:600; text-decoration:none; grid-column: span 2;">Descargar Excel</a>
                    </div>
                </form>
            </div>

            <div style="display:flex; flex-wrap:wrap; background:#fff; border-radius:12px; box-shadow:0 1px 2px rgba(0,0,0,.08); overflow:hidden;">
                <div style="flex:1 1 220px; padding:24px; border-right:1px solid rgba(156,163,175,.35); border-bottom:1px solid rgba(156,163,175,.2);">
                    <p class="text-sm text-gray-500">Visitas</p>
                    <p class="mt-2 text-3xl font-semibold text-gray-900">{{ $summary['visitas'] }}</p>
                </div>
                <div style="flex:1 1 220px; padding:24px; border-right:1px solid rgba(156,163,175,.35); border-bottom:1px solid rgba(156,163,175,.2);">
                    <p class="text-sm text-gray-500">Prisioneros</p>
                    <p class="mt-2 text-3xl font-semibold text-gray-900">{{ $summary['prisioneros'] }}</p>
                </div>
                <div style="flex:1 1 220px; padding:24px; border-bottom:1px solid rgba(156,163,175,.2);">
                    <p class="text-sm text-gray-500">Visitantes</p>
                    <p class="mt-2 text-3xl font-semibold text-gray-900">{{ $summary['visitantes'] }}</p>
                </div>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">{{ $title }}</h3>
                    <p class="text-sm text-gray-500">Rango {{ $filters['fecha_inicio'] }} a {{ $filters['fecha_fin'] }}</p>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Prisionero</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Visitante</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Guardia</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Fecha</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Inicio</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Fin</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @forelse ($visitas as $visita)
                                <tr>
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">{{ $visita->id }}</td>
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-700">{{ $visita->prisionero?->nombre_completo }}</td>
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-700">{{ $visita->visitante?->nombre_completo }}</td>
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-700">{{ $visita->guardia?->nombre_completo }}</td>
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-700">{{ $visita->fecha }}</td>
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-700">{{ $visita->hora_inicio }}</td>
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-700">{{ $visita->hora_fin }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-8 text-center text-sm text-gray-500">No hay registros para el rango seleccionado.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
