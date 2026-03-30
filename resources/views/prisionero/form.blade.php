<div class="space-y-6">
    
    <div>
        <x-input-label for="nombre_completo" :value="__('Nombre Completo')"/>
        <x-text-input id="nombre_completo" name="nombre_completo" type="text" class="mt-1 block w-full" :value="old('nombre_completo', $prisionero?->nombre_completo)" autocomplete="nombre_completo" placeholder="Nombre Completo"/>
        <x-input-error class="mt-2" :messages="$errors->get('nombre_completo')"/>
    </div>
    <div>
        <x-input-label for="fecha_nacimiento" :value="__('Fecha Nacimiento')"/>
        <x-text-input id="fecha_nacimiento" name="fecha_nacimiento" type="text" class="mt-1 block w-full" :value="old('fecha_nacimiento', $prisionero?->fecha_nacimiento)" autocomplete="fecha_nacimiento" placeholder="Fecha Nacimiento"/>
        <x-input-error class="mt-2" :messages="$errors->get('fecha_nacimiento')"/>
    </div>
    <div>
        <x-input-label for="fecha_ingreso" :value="__('Fecha Ingreso')"/>
        <x-text-input id="fecha_ingreso" name="fecha_ingreso" type="text" class="mt-1 block w-full" :value="old('fecha_ingreso', $prisionero?->fecha_ingreso)" autocomplete="fecha_ingreso" placeholder="Fecha Ingreso"/>
        <x-input-error class="mt-2" :messages="$errors->get('fecha_ingreso')"/>
    </div>
    <div>
        <x-input-label for="delito" :value="__('Delito')"/>
        <x-text-input id="delito" name="delito" type="text" class="mt-1 block w-full" :value="old('delito', $prisionero?->delito)" autocomplete="delito" placeholder="Delito"/>
        <x-input-error class="mt-2" :messages="$errors->get('delito')"/>
    </div>
    <div>
        <x-input-label for="celda" :value="__('Celda')"/>
        <x-text-input id="celda" name="celda" type="text" class="mt-1 block w-full" :value="old('celda', $prisionero?->celda)" autocomplete="celda" placeholder="Celda"/>
        <x-input-error class="mt-2" :messages="$errors->get('celda')"/>
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>Submit</x-primary-button>
    </div>
</div>