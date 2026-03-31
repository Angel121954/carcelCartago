<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Visitas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <div style="display:flex; flex-wrap:wrap; align-items:center; justify-content:space-between; gap:16px; margin-bottom:20px;">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">{{ __('Visitas') }}</h1>
                        <p class="text-sm text-gray-600">Listado general de visitas registradas</p>
                    </div>

                    <a href="{{ route('visitas.create') }}" style="display:inline-flex; align-items:center; justify-content:center; background:#4f46e5; color:#fff; padding:12px 18px; border-radius:10px; font-weight:700; text-decoration:none; box-shadow:0 8px 16px rgba(79,70,229,.18);">
                        + Nueva visita
                    </a>
                </div>

                <div class="overflow-x-auto" style="border:1px solid #e5e7eb; border-radius:12px;">
                    <table class="min-w-full" style="border-collapse:collapse; min-width:980px;">
                        <thead>
                            <tr style="background:#f3f4f6; color:#111827;">
                                <th class="py-3 px-4 text-left text-xs font-semibold uppercase tracking-wide">No</th>
                                <th class="py-3 px-4 text-left text-xs font-semibold uppercase tracking-wide">Prisionero</th>
                                <th class="py-3 px-4 text-left text-xs font-semibold uppercase tracking-wide">Visitante</th>
                                <th class="py-3 px-4 text-left text-xs font-semibold uppercase tracking-wide">Guardia</th>
                                <th class="py-3 px-4 text-left text-xs font-semibold uppercase tracking-wide">Fecha</th>
                                <th class="py-3 px-4 text-left text-xs font-semibold uppercase tracking-wide">Hora Inicio</th>
                                <th class="py-3 px-4 text-left text-xs font-semibold uppercase tracking-wide">Hora Fin</th>
                                <th class="py-3 px-4 text-left text-xs font-semibold uppercase tracking-wide" style="width:1%; white-space:nowrap;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($visitas as $visita)
                                <tr style="border-top:1px solid #e5e7eb;">
                                    <td class="py-4 px-4 text-sm font-semibold text-gray-900">{{ ++$i }}</td>
                                    <td class="py-4 px-4 text-sm text-gray-900">{{ $visita->prisionero?->nombre_completo ?? $visita->prisionero_id }}</td>
                                    <td class="py-4 px-4 text-sm text-gray-900">{{ $visita->visitante?->nombre_completo ?? $visita->visitante_id }}</td>
                                    <td class="py-4 px-4 text-sm text-gray-900">{{ $visita->guardia?->nombre_completo ?? $visita->guardia_id }}</td>
                                    <td class="py-4 px-4 text-sm text-gray-900">{{ $visita->fecha }}</td>
                                    <td class="py-4 px-4 text-sm text-gray-900">{{ $visita->hora_inicio }}</td>
                                    <td class="py-4 px-4 text-sm text-gray-900">{{ $visita->hora_fin }}</td>
                                    <td class="py-4 px-4 text-sm" style="width:1%; white-space:nowrap;">
                                        <div style="display:inline-flex; flex-wrap:nowrap; gap:8px; align-items:center;">
                                            <a href="{{ route('visitas.show', $visita->id) }}" style="background:#e5e7eb; color:#111827; padding:8px 12px; border-radius:8px; text-decoration:none; font-weight:600;">Ver</a>
                                            <a href="{{ route('visitas.edit', $visita->id) }}" style="background:#2563eb; color:#fff; padding:8px 12px; border-radius:8px; text-decoration:none; font-weight:600;">Editar</a>
                                            <form action="{{ route('visitas.destroy', $visita->id) }}" method="POST" style="display:inline; margin:0;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" style="background:#dc2626; color:#fff; padding:8px 12px; border:0; border-radius:8px; font-weight:600; cursor:pointer;" onclick="return confirm('Are you sure to delete?')">Eliminar</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {!! $visitas->withQueryString()->links() !!}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
