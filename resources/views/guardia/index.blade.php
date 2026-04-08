<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Guardias') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <div style="display:flex; flex-wrap:wrap; align-items:center; justify-content:space-between; gap:16px; margin-bottom:20px;">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">{{ __('Guardias') }}</h1>
                        <p class="text-sm text-gray-500">Administracion de perfiles de guardias</p>
                    </div>

                    <a href="{{ route('admin.guardias.create') }}" style="display:inline-flex; align-items:center; justify-content:center; background:#dc2626; color:#fff; padding:12px 18px; border-radius:10px; font-weight:700; text-decoration:none; box-shadow:0 8px 16px rgba(220,38,38,.18);">
                        + Nuevo guardia
                    </a>
                </div>

                <div class="overflow-x-auto" style="border:1px solid #e5e7eb; border-radius:12px;">
                    <table class="w-full" style="border-collapse:collapse; table-layout:auto;">
                        <thead>
                            <tr style="background:#f3f4f6; color:#111827;">
                                <th class="py-3 px-4 text-left text-xs font-semibold uppercase tracking-wide">No</th>
                                <th class="py-3 px-4 text-left text-xs font-semibold uppercase tracking-wide">Nombre Completo</th>
                                <th class="py-3 px-4 text-left text-xs font-semibold uppercase tracking-wide">Numero Identificacion</th>
                                <th class="py-3 px-4 text-left text-xs font-semibold uppercase tracking-wide">Activo</th>
                                <th class="py-3 px-4 text-left text-xs font-semibold uppercase tracking-wide" style="width:1%; white-space:nowrap;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($guardias as $guardia)
                                <tr style="border-top:1px solid #e5e7eb;">
                                    <td class="py-4 px-4 text-sm font-semibold text-gray-900">{{ ++$i }}</td>
                                    <td class="py-4 px-4 text-sm text-gray-900">{{ $guardia->nombre_completo }}</td>
                                    <td class="py-4 px-4 text-sm text-gray-900">{{ $guardia->numero_identificacion }}</td>
                                    <td class="py-4 px-4 text-sm text-gray-900">
                                        @if ($guardia->activo)
                                            <span style="display:inline-flex; padding:6px 10px; border-radius:9999px; background:#dcfce7; color:#166534; font-weight:700; font-size:12px;">Activo</span>
                                        @else
                                            <span style="display:inline-flex; padding:6px 10px; border-radius:9999px; background:#fee2e2; color:#991b1b; font-weight:700; font-size:12px;">Inactivo</span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-4 text-sm" style="width:1%; white-space:nowrap;">
                                        <div style="display:inline-flex; flex-wrap:nowrap; gap:8px; align-items:center;">
                                            <a href="{{ route('admin.guardias.show', $guardia->id) }}" style="background:#e5e7eb; color:#111827; padding:8px 12px; border-radius:8px; text-decoration:none; font-weight:600;">Ver</a>
                                            <a href="{{ route('admin.guardias.edit', $guardia->id) }}" style="background:#2563eb; color:#fff; padding:8px 12px; border-radius:8px; text-decoration:none; font-weight:600;">Editar</a>
                                            <form action="{{ route('admin.guardias.destroy', $guardia->id) }}" method="POST" style="display:inline; margin:0;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" style="background:#dc2626; color:#fff; padding:8px 12px; border:0; border-radius:8px; font-weight:600; cursor:pointer;" onclick="return confirm('¿Dar de baja a este guardia?')">Dar de baja</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {!! $guardias->withQueryString()->links() !!}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
