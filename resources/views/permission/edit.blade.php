<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            Edit Hak Akses {{ $permission->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('permission.update', $permission) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="flex flex-col space-y-2">
                            <x-input-label for="name" :value="'Nama'" />
                            <x-text-input type="text" id="name" name="name" value="{{ $permission->name }}" />
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        <div class="mt-2 space-x-1">
                            <x-primary-button>Perbarui</x-primary-button>
                            <x-secondary-link href="{{ route('permission') }}">Kembali</x-secondary-link>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>