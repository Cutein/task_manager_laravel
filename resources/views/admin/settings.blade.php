<x-app-layout>
    <div class="max-w-4xl mx-auto py-6">
        <h2 class="text-2xl font-semibold mb-4">Configuraciones Generales</h2>

        @if(session('success'))
            <div class="bg-green-500 text-white p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow">
            @csrf
            @method('PUT')

            <!-- Nombre de la Aplicación -->
            <div class="mb-4">
                <label for="app_name" class="block font-medium">Nombre de la Aplicación:</label>
                <input type="text" id="app_name" name="app_name" value="{{ old('app_name', \App\Models\Setting::get('app_name')) }}" class="w-full border-gray-300 rounded">
            </div>

            <!-- Logo -->
            <div class="mb-4">
                <label for="app_logo" class="block font-medium">Logo:</label>
                <input type="file" id="app_logo" name="app_logo" class="w-full border-gray-300 rounded">
                <div class="mt-2">
                    <img src="{{ asset('storage/' . \App\Models\Setting::get('app_logo')) }}" alt="Logo" class="h-16">
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Guardar Cambios</button>
            </div>
        </form>
    </div>
</x-app-layout>
