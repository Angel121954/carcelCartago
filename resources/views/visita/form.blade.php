<div class="space-y-6">

    <div>
        <x-input-label for="prisionero_id" :value="__('Prisionero')" />
        <select id="prisionero_id" name="prisionero_id"
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            <option value="">-- Seleccionar prisionero --</option>
            @foreach($prisioneros as $p)
                <option value="{{ $p->id }}"
                    {{ old('prisionero_id', $visita?->prisionero_id) == $p->id ? 'selected' : '' }}>
                    {{ $p->nombre_completo }} (Celda: {{ $p->celda }})
                </option>
            @endforeach
        </select>
        <x-input-error class="mt-2" :messages="$errors->get('prisionero_id')" />
    </div>

    <div>
        <x-input-label for="visitante_id" :value="__('Visitante')" />
        <select id="visitante_id" name="visitante_id"
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            <option value="">-- Seleccionar visitante --</option>
            @foreach($visitantes as $v)
                <option value="{{ $v->id }}"
                    {{ old('visitante_id', $visita?->visitante_id) == $v->id ? 'selected' : '' }}>
                    {{ $v->nombre_completo }} ({{ $v->relacion }})
                </option>
            @endforeach
        </select>
        <x-input-error class="mt-2" :messages="$errors->get('visitante_id')" />
    </div>

    <div>
        <x-input-label for="fecha" :value="__('Fecha (solo domingos)')" />
        <x-text-input id="fecha" name="fecha" type="date"
            class="mt-1 block w-full"
            :value="old('fecha', $visita?->fecha)" />
        <p class="mt-1 text-xs text-gray-500">Las visitas solo se permiten los <strong>domingos</strong>.</p>
        <x-input-error class="mt-2" :messages="$errors->get('fecha')" />
    </div>

    <div>
        <x-input-label for="hora_inicio" :value="__('Hora Inicio (14:00 – 17:00)')" />
        <x-text-input id="hora_inicio" name="hora_inicio" type="time"
            min="14:00" max="17:00"
            class="mt-1 block w-full"
            :value="old('hora_inicio', $visita?->hora_inicio)" />
        <x-input-error class="mt-2" :messages="$errors->get('hora_inicio')" />
    </div>

    <div>
        <x-input-label for="hora_fin" :value="__('Hora Fin (14:00 – 17:00)')" />
        <x-text-input id="hora_fin" name="hora_fin" type="time"
            min="14:00" max="17:00"
            class="mt-1 block w-full"
            :value="old('hora_fin', $visita?->hora_fin)" />
        <x-input-error class="mt-2" :messages="$errors->get('hora_fin')" />
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Guardar Visita</x-primary-button>
    </div>
</div>
