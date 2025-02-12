<x-app-layout>
    <div class="max-w-4xl mx-auto py-6">
        <h2 class="text-2xl font-semibold mb-4">Editar Usuario</h2>

        <form action="{{ route('admin.users.update', $user) }}" method="POST" class="bg-white p-6 rounded shadow">
            @csrf
            @method('PUT')

            <!-- Nombre -->
            <div class="mb-4">
                <label for="name" class="block font-medium">Nombre:</label>
                <input type="text" id="name" name="name" value="{{ $user->name }}" class="w-full border-gray-300 rounded">
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block font-medium">Email:</label>
                <input type="email" id="email" name="email" value="{{ $user->email }}" class="w-full border-gray-300 rounded">
            </div>
            <div>
            </div>
            <!-- Rol -->
            <div class="mb-4">
                <label for="role" class="block font-medium">Rol:</label>
                <select id="role" name="role" class="w-full border-gray-300 rounded">
                    <option value="user" {{ $user->role=='user' ? 'selected' : '' }}>Usuario</option>
                    <option value="admin" {{ $user->role=='admin' ? 'selected' : '' }}>Administrador</option>
                </select>
            </div>

            <!-- Estado -->
            <div class="mb-4">
                <label for="is_active" class="block font-medium">Estado:</label>
                <select id="is_active" name="is_active" class="w-full border-gray-300 rounded">
                    <option value="1" {{ $user->is_active ? 'selected' : '' }}>Activo</option>
                    <option value="0" {{ !$user->is_active ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Actualizar</button>
            </div>
        </form>
    </div>
</x-app-layout>
