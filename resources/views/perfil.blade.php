<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Mi Perfil
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">
                    Información del Usuario
                </h3>
                <p><strong>Nombre:</strong> {{ $user->name }}</p>
                <p><strong>Correo:</strong> {{ $user->email }}</p>
                <p><strong>Teléfono:</strong> {{ $user->telefono }}</p>
            </div>
        </div>
    </div>
</x-app-layout>