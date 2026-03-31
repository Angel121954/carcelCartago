<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard - Cárcel El Redentor
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- TARJETAS -->
            <div class="grid grid-cols-4 gap-4 mb-6">

                <div class="bg-blue-500 text-white p-4 rounded shadow">
                    <h3>Prisioneros</h3>
                    <p class="text-2xl">{{ $prisioneros }}</p>
                </div>

                <div class="bg-green-500 text-white p-4 rounded shadow">
                    <h3>Visitantes</h3>
                    <p class="text-2xl">{{ $visitantes }}</p>
                </div>

                <div class="bg-yellow-500 text-white p-4 rounded shadow">
                    <h3>Visitas</h3>
                    <p class="text-2xl">{{ $visitas }}</p>
                </div>

                @if(auth()->user()->role == 'admin')
                <a href="{{ route('admin.guardias.index') }}" class="bg-red-600 text-white px-4 py-2 rounded">
                    Gestionar Guardias
                </a>
                @endif

            </div>

            <!-- BOTONES -->
            <div class="mb-6 flex gap-4">
                <a href="{{ route('visitas.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded">
                    Nueva Visita
                </a>

                @if(auth()->user()?->isAdmin())
                <a href="{{ route('admin.reportes.index') }}" class="bg-red-600 text-white px-4 py-2 rounded">
                    Informes
                </a>
                @endif

                <a href="{{ route('prisioneros.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded">
                    Ver Prisioneros
                </a>

                <a href="{{ route('visitantes.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded">
                    Ver Visitantes
                </a>
            </div>

            <!-- TABLA -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <h2 class="text-xl mb-4">Últimas Visitas</h2>

                    <table class="table-auto w-full border">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="p-2">Prisionero</th>
                                <th class="p-2">Visitante</th>
                                <th class="p-2">Guardia</th>
                                <th class="p-2">Fecha</th>
                                <th class="p-2">Hora</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ultimasVisitas as $v)
                            <tr class="border-t">
                                <td class="p-2">{{ $v->prisionero->nombre_completo }}</td>
                                <td class="p-2">{{ $v->visitante->nombre_completo }}</td>
                                <td class="p-2">{{ $v->guardia->nombre_completo }}</td>
                                <td class="p-2">{{ $v->fecha }}</td>
                                <td class="p-2">{{ $v->hora_inicio }} - {{ $v->hora_fin }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
