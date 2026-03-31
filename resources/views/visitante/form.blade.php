<div class="space-y-6">
    
    <div>
        <x-input-label for="nombre_completo" :value="__('Nombre Completo')"/>
        <x-text-input id="nombre_completo" name="nombre_completo" type="text" class="mt-1 block w-full" :value="old('nombre_completo', $visitante?->nombre_completo)" autocomplete="nombre_completo" placeholder="Nombre Completo"/>
        <x-input-error class="mt-2" :messages="$errors->get('nombre_completo')"/>
    </div>
    <div>
        <x-input-label for="numero_identificacion" :value="__('Numero Identificacion')"/>
        <x-text-input id="numero_identificacion" name="numero_identificacion" type="text" class="mt-1 block w-full" :value="old('numero_identificacion', $visitante?->numero_identificacion)" autocomplete="numero_identificacion" placeholder="Numero Identificacion"/>
        <x-input-error class="mt-2" :messages="$errors->get('numero_identificacion')"/>
    </div>
    <div>
        <x-input-label for="relacion" :value="__('Relacion')"/>
        <x-text-input id="relacion" name="relacion" type="text" class="mt-1 block w-full" :value="old('relacion', $visitante?->relacion)" autocomplete="relacion" placeholder="Relacion"/>
        <x-input-error class="mt-2" :messages="$errors->get('relacion')"/>
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Submit</x-primary-button>
    </div>
</div>