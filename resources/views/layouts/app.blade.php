<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Gestión de Proyectos
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Mensaje de éxito --}}
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 border border-green-300 rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Añadir Nuevo Proyecto</h3>
                        
                        {{-- Muestra errores de validación --}}
                        <x-auth-session-status class="mb-4" :status="session('status')" />
                        
                        <form action="{{ route('admin.projects.store') }}" method="POST">
                            @csrf
                            <div>
                                <label for="name" class="block font-medium text-sm text-gray-700">Nombre del Proyecto</label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" class="block mt-1 w-full rounded-md shadow-sm border-gray-300" required>
                                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div class="mt-4">
                                <label for="description" class="block font-medium text-sm text-gray-700">Descripción (Opcional)</label>
                                <textarea name="description" id="description" rows="3" class="block mt-1 w-full rounded-md shadow-sm border-gray-300">{{ old('description') }}</textarea>
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                                    Guardar Proyecto
                                </button>
                            </div>
                        </form>
                    </div>

                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Proyectos Actuales</h3>
                        <div class="border rounded-lg overflow-hidden">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    {{-- Cambiamos $projects por $priorities que es la que envía el controlador --}}
                                    @forelse ($priorities as $priority)
                                        <tr>
                                            {{-- Mostramos el nombre de la prioridad --}}
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $priority->name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="#" class="text-indigo-600 hover:text-indigo-900">Editar</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            {{-- Mensaje correcto --}}
                                            <td colspan="2" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">No hay prioridades registradas.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>