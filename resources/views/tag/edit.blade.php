<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            Edit Tag {{ $tag->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('tag.update', $tag) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="flex flex-col space-y-2">
                            <label for="name">Nama</label>
                            <x-text-input type="text" id="name" name="name" value="{{ $tag->name }}" />
                        </div>
                        @error('name')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                        <div class="mt-2 space-x-1">
                            <x-primary-button>Perbarui</x-primary-button>
                            <x-secondary-link href="{{ route('tag') }}">Kembali</x-secondary-link>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>