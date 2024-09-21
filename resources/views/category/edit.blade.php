<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            Edit Kategori {{ $category->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div>
                        <form action="{{ route('category.update', $category) }}" method="post">
                            @csrf
                            @method('put')
                            <div class="flex flex-col space-y-2">
                                <label for="name">Nama</label>
                                <input type="text" id="name" name="name" value="{{ $category->name }}" class="border-gray-300 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600">
                            </div>
                            @error('name')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                            <div class="mt-2 space-x-1">
                                <x-primary-button>Perbarui</x-primary-button>
                                <x-secondary-link href="{{ route('category') }}">Kembali</x-secondary-link>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>