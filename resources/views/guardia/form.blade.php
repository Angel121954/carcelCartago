<div class="space-y-6">

    <div>
        <x-input-label for="nombre_completo" :value="__('Nombre Completo')"/>
        <x-text-input id="nombre_completo" name="nombre_completo" type="text"
            class="mt-1 block w-full"
            :value="old('nombre_completo', $guardia?->nombre_completo)"
            placeholder="Nombre completo del guardia"/>
        <x-input-error class="mt-2" :messages="$errors->get('nombre_completo')"/>
    </div>

    <div>
        <x-input-label for="numero_identificacion" :value="__('Número de Identificación')"/>
        <x-text-input id="numero_identificacion" name="numero_identificacion" type="text"
            class="mt-1 block w-full"
            :value="old('numero_identificacion', $guardia?->numero_identificacion)"
            placeholder="Número de identificación"/>
        <x-input-error class="mt-2" :messages="$errors->get('numero_identificacion')"/>
    </div>

    @if($guardia?->exists)
        <div>
            <x-input-label :value="__('Estado')"/>
            <div class="mt-2 flex items-center gap-3">
                <input type="hidden" name="activo" value="0">
                <input id="activo" name="activo" type="checkbox" value="1"
                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                    {{ old('activo', $guardia?->activo) ? 'checked' : '' }}>
                <label for="activo" class="text-sm text-gray-700">Guardia activo</label>
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('activo')"/>
        </div>
    @endif

    <div class="flex items-center gap-4">
        <x-primary-button>Guardar</x-primary-button>
    </div>
</div>
