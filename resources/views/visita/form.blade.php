<div class="space-y-6">
    
    <div>
        <x-input-label for="prisionero_id" :value="__('Prisionero Id')"/>
        <x-text-input id="prisionero_id" name="prisionero_id" type="text" class="mt-1 block w-full" :value="old('prisionero_id', $visita?->prisionero_id)" autocomplete="prisionero_id" placeholder="Prisionero Id"/>
        <x-input-error class="mt-2" :messages="$errors->get('prisionero_id')"/>
    </div>
    <div>
        <x-input-label for="visitante_id" :value="__('Visitante Id')"/>
        <x-text-input id="visitante_id" name="visitante_id" type="text" class="mt-1 block w-full" :value="old('visitante_id', $visita?->visitante_id)" autocomplete="visitante_id" placeholder="Visitante Id"/>
        <x-input-error class="mt-2" :messages="$errors->get('visitante_id')"/>
    </div>
    <div>
        <x-input-label for="guardia_id" :value="__('Guardia Id')"/>
        <x-text-input id="guardia_id" name="guardia_id" type="text" class="mt-1 block w-full" :value="old('guardia_id', $visita?->guardia_id)" autocomplete="guardia_id" placeholder="Guardia Id"/>
        <x-input-error class="mt-2" :messages="$errors->get('guardia_id')"/>
    </div>
    <div>
        <x-input-label for="fecha" :value="__('Fecha')"/>
        <x-text-input id="fecha" name="fecha" type="text" class="mt-1 block w-full" :value="old('fecha', $visita?->fecha)" autocomplete="fecha" placeholder="Fecha"/>
        <x-input-error class="mt-2" :messages="$errors->get('fecha')"/>
    </div>
    <div>
        <x-input-label for="hora_inicio" :value="__('Hora Inicio')"/>
        <x-text-input id="hora_inicio" name="hora_inicio" type="text" class="mt-1 block w-full" :value="old('hora_inicio', $visita?->hora_inicio)" autocomplete="hora_inicio" placeholder="Hora Inicio"/>
        <x-input-error class="mt-2" :messages="$errors->get('hora_inicio')"/>
    </div>
    <div>
        <x-input-label for="hora_fin" :value="__('Hora Fin')"/>
        <x-text-input id="hora_fin" name="hora_fin" type="text" class="mt-1 block w-full" :value="old('hora_fin', $visita?->hora_fin)" autocomplete="hora_fin" placeholder="Hora Fin"/>
        <x-input-error class="mt-2" :messages="$errors->get('hora_fin')"/>
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Submit</x-primary-button>
    </div>
</div>