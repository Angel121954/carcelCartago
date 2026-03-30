<div class="space-y-6">

    <div>
        <x-input-label for="nombre_completo" :value="__('Nombre Completo')" />
        <x-text-input id="nombre_completo" name="nombre_completo" type="text"
            class="mt-1 block w-full"
            :value="old('nombre_completo', $visitante?->nombre_completo)"
            autocomplete="off"
            placeholder="Ej: Juan Carlos Pérez López" />
        <x-input-error class="mt-2" :messages="$errors->get('nombre_completo')" />
    </div>

    <div>
        <x-input-label for="numero_identificacion" :value="__('Número de Identificación')" />
        <x-text-input id="numero_identificacion" name="numero_identificacion" type="text"
            class="mt-1 block w-full"
            :value="old('numero_identificacion', $visitante?->numero_identificacion)"
            autocomplete="off"
            placeholder="Ej: 1234567890" />
        <x-input-error class="mt-2" :messages="$errors->get('numero_identificacion')" />
    </div>

    <div>
        <x-input-label for="relacion" :value="__('Relación con el Prisionero')" />
        <x-text-input id="relacion" name="relacion" type="text"
            class="mt-1 block w-full"
            :value="old('relacion', $visitante?->relacion)"
            autocomplete="off"
            placeholder="Ej: Familiar, Abogado, Amigo" />
        <x-input-error class="mt-2" :messages="$errors->get('relacion')" />
    </div>

    {{-- ── Botones de acción ── --}}
    <div class="flex items-center gap-4 pt-2">
        <x-primary-button>
            Registrar Visitante
        </x-primary-button>

        <a href="{{ route('visitantes.index') }}"
            class="inline-flex items-center rounded-md bg-white px-4 py-2 text-sm font-semibold text-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
            Cancelar
        </a>
    </div>

</div>