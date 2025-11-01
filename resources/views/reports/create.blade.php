<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Enviar Reporte Semanal
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    {{-- Muestra errores de validación --}}
                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-100 text-red-700 border border-red-300 rounded-md">
                            <strong>¡Ups!</strong> Hubo algunos problemas con tu envío.
                            <ul class="mt-2 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- MUY IMPORTANTE: enctype="multipart/form-data" para permitir la subida de archivos --}}
                    <form action="{{ route('reports.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mt-4">
                            <label for="project_id" class="block font-medium text-sm text-gray-700">Proyecto</label>
                            <select name="project_id" id="project_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300" required>
                                <option value="">-- Selecciona un proyecto --</option>
                                @foreach ($projects as $project)
                                    <option value="{{ $project->id }}" {{ old('project_id') == $project->id ? 'selected' : '' }}>
                                        {{ $project->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-4">
                            <label for="report_type_id" class="block font-medium text-sm text-gray-700">Tipo de Reporte</label>
                            <select name="report_type_id" id="report_type_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300" required>
                                <option value="">-- Selecciona el tipo --</option>
                                @foreach ($reportTypes as $type)
                                    <option value="{{ $type->id }}" {{ old('report_type_id') == $type->id ? 'selected' : '' }}>
                                        {{ $type->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-4">
                            <label for="priority_id" class="block font-medium text-sm text-gray-700">Prioridad</label>
                            <select name="priority_id" id="priority_id" class="block mt-1 w-full rounded-md shadow-sm border-gray-300" required>
                                <option value="">-- Selecciona la prioridad --</option>
                                @foreach ($priorities as $priority)
                                    <option value="{{ $priority->id }}" {{ old('priority_id') == $priority->id ? 'selected' : '' }}>
                                        {{ $priority->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="mt-4">
                             <label for="report_date" class="block font-medium text-sm text-gray-700">Fecha del Reporte</label>
                             <input type-="date" name="report_date" id="report_date" value="{{ old('report_date', date('Y-m-d')) }}" class="block mt-1 w-full rounded-md shadow-sm border-gray-300" required>
                        </div>

                        <div class="mt-4">
                            <label for="body" class="block font-medium text-sm text-gray-700">Detalles del Reporte</Cuerpo>
                            <textarea name="body" id="body" rows="8" class="block mt-1 w-full rounded-md shadow-sm border-gray-300" placeholder="Escribe aquí los detalles de tu avance...">{{ old('body') }}</textarea>
                        </div>

                        <div class="mt-4">
                            <label for="attachment" class="block font-medium text-sm text-gray-700">Adjuntar Archivo (Opcional)</label>
                            <input type="file" name="attachment" id="attachment" class="block mt-1 w-full border border-gray-300 rounded-md p-2">
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <button type="submit" class="inline-flex items-center px-6 py-3 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700">
                                Enviar Reporte
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>