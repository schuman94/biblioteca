<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Proyecciones
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex gap-x-20">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Película
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Sala
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Fecha
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Hora
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Adquirir entrada
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($proyecciones as $proyeccion)
                                        <tr
                                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                <a href="{{ route('peliculas.show', $proyeccion->pelicula) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                                    {{ $proyeccion->pelicula->titulo }}
                                                </a>
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ $proyeccion->sala->numero }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $proyeccion->fecha_hora->setTimezone('Europe/Madrid')->format('d-m-Y') }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $proyeccion->fecha_hora->setTimezone('Europe/Madrid')->format('H:i:s') }}
                                            </td>
                                            <td class="px-6 py-4 flex items-center gap-2">
                                                <form method="POST" action="{{ route('entradas.store') }}">
                                                    @csrf
                                                    <input type="hidden" name="proyeccion_id" value="{{ $proyeccion->id }}">
                                                    <a href="{{ route('entradas.store') }}"
                                                        class="font-medium text-green-600 dark:text-green-500 hover:underline ms-3"
                                                        onclick="event.preventDefault(); if (confirm('¿Está seguro?')) this.closest('form').submit();">
                                                        Comprar
                                                    </a>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-6 text-center">
                            <a href="{{ route('proyecciones.create') }}"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                Crear una nueva proyeccion
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
