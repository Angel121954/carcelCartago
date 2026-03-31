<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard - Cárcel El Redentor
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(180px,1fr)); gap:16px; margin-bottom:24px;">
                <div style="background:#0f172a; color:#fff; padding:20px; border-radius:14px; box-shadow:0 8px 20px rgba(15,23,42,.14);">
                    <p style="margin:0; font-size:14px; opacity:.8;">Prisioneros</p>
                    <p style="margin:8px 0 0; font-size:34px; font-weight:800; line-height:1;">{{ $prisioneros }}</p>
                </div>

                <div style="background:#14532d; color:#fff; padding:20px; border-radius:14px; box-shadow:0 8px 20px rgba(20,83,45,.14);">
                    <p style="margin:0; font-size:14px; opacity:.85;">Visitantes</p>
                    <p style="margin:8px 0 0; font-size:34px; font-weight:800; line-height:1;">{{ $visitantes }}</p>
                </div>

                <div style="background:#7c2d12; color:#fff; padding:20px; border-radius:14px; box-shadow:0 8px 20px rgba(124,45,18,.14);">
                    <p style="margin:0; font-size:14px; opacity:.85;">Visitas</p>
                    <p style="margin:8px 0 0; font-size:34px; font-weight:800; line-height:1;">{{ $visitas }}</p>
                </div>

                @if(auth()->user()?->isAdmin())
                    <a href="{{ route('admin.guardias.index') }}" style="background:#b91c1c; color:#fff; padding:20px; border-radius:14px; box-shadow:0 8px 20px rgba(185,28,28,.14); text-decoration:none; display:block;">
                        <p style="margin:0; font-size:14px; opacity:.9;">Guardias</p>
                        <p style="margin:8px 0 0; font-size:20px; font-weight:700; line-height:1.2;">Gestionar Guardias</p>
                    </a>
                @endif
            </div>

            <!-- BOTONES -->
            <div class="mb-6 flex flex-wrap gap-4">
                <a href="{{ route('visitas.create') }}" style="background:#4f46e5; color:#fff; padding:10px 16px; border-radius:10px; text-decoration:none;">
                    Nueva Visita
                </a>

                @if(auth()->user()?->isAdmin())
                <a href="{{ route('admin.reportes.index') }}" style="background:#dc2626; color:#fff; padding:10px 16px; border-radius:10px; text-decoration:none;">
                    Informes
                </a>
                @endif

                <a href="{{ route('prisioneros.index') }}" style="background:#374151; color:#fff; padding:10px 16px; border-radius:10px; text-decoration:none;">
                    Ver Prisioneros
                </a>

                <a href="{{ route('visitantes.index') }}" style="background:#374151; color:#fff; padding:10px 16px; border-radius:10px; text-decoration:none;">
                    Ver Visitantes
                </a>
            </div>

            <!-- TABLA -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-xl mb-4 text-gray-900 font-semibold">Últimas Visitas</h2>

                    <div class="overflow-x-auto">
                        <table class="table-auto w-full border-collapse">
                            <thead>
                                <tr style="background:#e5e7eb; color:#111827;">
                                    <th class="p-3 text-left">Prisionero</th>
                                    <th class="p-3 text-left">Visitante</th>
                                    <th class="p-3 text-left">Guardia</th>
                                    <th class="p-3 text-left">Fecha</th>
                                    <th class="p-3 text-left">Hora</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ultimasVisitas as $v)
                                <tr style="border-top:1px solid #e5e7eb;">
                                    <td class="p-3 text-gray-900">{{ $v->prisionero->nombre_completo }}</td>
                                    <td class="p-3 text-gray-900">{{ $v->visitante->nombre_completo }}</td>
                                    <td class="p-3 text-gray-900">{{ $v->guardia->nombre_completo }}</td>
                                    <td class="p-3 text-gray-900">{{ $v->fecha }}</td>
                                    <td class="p-3 text-gray-900">{{ $v->hora_inicio }} - {{ $v->hora_fin }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
