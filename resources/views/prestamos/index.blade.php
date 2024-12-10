<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Préstamos
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
                                            Cliente
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Libro
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Ejemplar
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Fecha inicio
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Fecha devolución
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Devolver
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($prestamos as $prestamo)
                                        <tr
                                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                <a href="{{ route('clientes.show', $prestamo->cliente) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                                    {{ $prestamo->cliente->nombre }}
                                                </a>
                                            </th>
                                            <td class="px-6 py-4">
                                                <a href="{{ route('libros.show', $prestamo->ejemplar->libro) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                                    {{ $prestamo->ejemplar->libro->titulo }}
                                                </a>
                                            </td>
                                            <td class="px-6 py-4">
                                                <a href="{{ route('ejemplares.show', $prestamo->ejemplar) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                                    {{ $prestamo->ejemplar->codigo }}
                                                </a>
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $prestamo->fecha_hora->setTimezone('Europe/Madrid')->format('d-m-Y H:i') }}
                                            </td>
                                            <td class="px-6 py-4">
                                                @isset ($prestamo->fecha_dev)
                                                    {{ $prestamo->fecha_dev->setTimezone('Europe/Madrid')->format('Y-m-d H:i') }}
                                                @else
                                                    {{ $prestamo->fecha_hora->addMonth()->locale('es')->diffForHumans() }}
                                                @endisset
                                            </td>
                                            <td class="px-6 py-4 flex items-center gap-2">
                                                @if (!$prestamo->fecha_dev)
                                                    <form method="POST" action="{{ route('prestamos.devolver', $prestamo) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <a href="{{ route('prestamos.devolver', $prestamo) }}"
                                                            @if ($prestamo->esta_vencido())
                                                                class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3"
                                                            @else
                                                                class="font-medium text-green-600 dark:text-green-500 hover:underline ms-3"
                                                            @endif
                                                            onclick="event.preventDefault(); if (confirm('¿Está seguro?')) this.closest('form').submit();">
                                                            Devolver
                                                        </a>
                                                    </form>
                                                @endif
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-6 text-center">
                            <a href="{{ route('prestamos.create') }}"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                Crear un nuevo prestamo
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
