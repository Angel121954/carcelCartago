<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Registrar') }} Visitante
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="w-full">

                    {{-- ── Encabezado con título y botón Volver ── --}}
                    <div class="sm:flex sm:items-center">
                        <div class="sm:flex-auto">
                            <h1 class="text-base font-semibold leading-6 text-gray-900">Registrar Visitante</h1>
                            <p class="mt-2 text-sm text-gray-700">Complete los datos para registrar un nuevo visitante en el sistema.</p>
                        </div>
                        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                            <a href="{{ route('visitantes.index') }}"
                                class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                Volver
                            </a>
                        </div>
                    </div>

                    {{-- ══════════════════════════════════════════════════════════════ --}}
                    {{-- ALERTA DE DUPLICADO — detectada al enviar el formulario       --}}
                    {{-- ══════════════════════════════════════════════════════════════ --}}
                    @if (session('duplicado_id'))
                    <div id="alerta-duplicado"
                        class="mt-6 rounded-lg border-l-4 border-yellow-400 bg-yellow-50 p-4"
                        role="alert">
                        <div class="flex items-start gap-3">
                            <div class="flex-shrink-0 pt-0.5">
                                <svg class="h-5 w-5 text-yellow-500" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495zM10 5a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 5zm0 9a1 1 0 100-2 1 1 0 000 2z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-sm font-semibold text-yellow-800">Visitante ya registrado</h3>
                                <p class="mt-1 text-sm text-yellow-700">
                                    El número de identificación
                                    <strong>{{ session('duplicado_numero') }}</strong>
                                    ya pertenece a
                                    <strong>{{ session('duplicado_nombre') }}</strong>.
                                </p>
                                <div class="mt-3 flex flex-wrap gap-3">
                                    <a href="{{ route('visitantes.show', session('duplicado_id')) }}"
                                        class="inline-flex items-center rounded-md bg-yellow-100 px-3 py-1.5 text-sm font-medium text-yellow-800 ring-1 ring-inset ring-yellow-300 hover:bg-yellow-200">
                                        Ver perfil del visitante
                                    </a>
                                    <a href="{{ route('visitantes.edit', session('duplicado_id')) }}"
                                        class="inline-flex items-center rounded-md bg-white px-3 py-1.5 text-sm font-medium text-yellow-800 ring-1 ring-inset ring-yellow-300 hover:bg-yellow-50">
                                        Editar registro existente
                                    </a>
                                </div>
                            </div>
                            <button type="button"
                                onclick="document.getElementById('alerta-duplicado').remove()"
                                class="flex-shrink-0 text-yellow-500 hover:text-yellow-700"
                                aria-label="Cerrar alerta">
                                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    @endif

                    {{-- ══════════════════════════════════════════════════════════════ --}}
                    {{-- ALERTA EN TIEMPO REAL — se muestra mientras el usuario escribe --}}
                    {{-- ══════════════════════════════════════════════════════════════ --}}
                    <div id="alerta-ajax"
                        class="hidden mt-6 rounded-lg border-l-4 border-yellow-400 bg-yellow-50 p-4"
                        role="alert">
                        <div class="flex items-start gap-3">
                            <div class="flex-shrink-0 pt-0.5">
                                <svg class="h-5 w-5 text-yellow-500" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495zM10 5a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0110 5zm0 9a1 1 0 100-2 1 1 0 000 2z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-sm font-semibold text-yellow-800">Visitante ya registrado</h3>
                                <p class="mt-1 text-sm text-yellow-700" id="alerta-ajax-texto"></p>
                                <div class="mt-3 flex flex-wrap gap-3">
                                    <a id="alerta-ajax-ver" href="#"
                                        class="inline-flex items-center rounded-md bg-yellow-100 px-3 py-1.5 text-sm font-medium text-yellow-800 ring-1 ring-inset ring-yellow-300 hover:bg-yellow-200">
                                        Ver perfil del visitante
                                    </a>
                                    <a id="alerta-ajax-editar" href="#"
                                        class="inline-flex items-center rounded-md bg-white px-3 py-1.5 text-sm font-medium text-yellow-800 ring-1 ring-inset ring-yellow-300 hover:bg-yellow-50">
                                        Editar registro existente
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ── Formulario ── --}}
                    <div class="flow-root">
                        <div class="mt-8 overflow-x-auto">
                            <div class="max-w-xl py-2 align-middle">
                                <form method="POST" action="{{ route('visitantes.store') }}"
                                    role="form" enctype="multipart/form-data">
                                    @csrf
                                    @include('visitante.form')
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- data-* attributes pass Laravel URLs to the JS without hardcoding them --}}
    <script
        src="{{ asset('js/verificacionReal.js') }}"
        data-check-url="{{ route('visitantes.check-duplicado') }}"
        data-field-id="numero_identificacion">
    </script>
</x-app-layout>