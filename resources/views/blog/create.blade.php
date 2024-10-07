<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            Tambah Blog
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('blog.store') }}" method="post" class="space-y-4" enctype="multipart/form-data">
                        @csrf
                        <div class="flex flex-col space-y-2">
                            <x-input-label for="title" :value="'Judul'" />
                            <x-text-input type="text" id="title" name="title" value="{{ old('title') }}" />
                        </div>
                        <x-input-error :messages="$errors->get('title')" />
                        <div class="flex flex-col space-y-2">
                            <x-input-label for="image" :value="'Gambar'" />
                            <x-text-input type="file" accept=".jpg, .jpeg, .png" id="image" name="image" class="focus:outline-none" />
                        </div>
                        <x-input-error :messages="$errors->get('image')" />
                        <div class="flex flex-col space-y-2">
                            <x-input-label for="short_description" :value="'Deskripsi Singkat'" />
                            <x-text-area id="short_description" name="short_description" rows='3'></x-text-area>
                        </div>
                        <x-input-error :messages="$errors->get('short_description')" />
                        <div class="flex flex-col space-y-2">
                            <x-input-label for="description" :value="'Deskripsi'" />
                            <x-text-area id="description" name="description" rows='6'></x-text-area>
                        </div>
                        <x-input-error :messages="$errors->get('description')" />
                        <div class="flex flex-col space-y-2">
                            <x-input-label for="category" :value="'Kategori'" />
                            <x-select id="category" name="category">
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </x-select>
                        </div>
                        <x-input-error :messages="$errors->get('category')" />
                        <div class="flex flex-col space-y-2">
                            <x-input-label for="tag" :value="'Tag'" />
                            <x-select class="select2" id="tag" name="tag[]" multiple>
                                @foreach ($tags as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                @endforeach
                            </x-select>
                        </div>
                        <x-input-error :messages="$errors->get('tag')" />
                        <div class="mt-2 space-x-1">
                            <x-primary-button>Simpan</x-primary-button>
                            <x-secondary-link href="{{ route('blog') }}">Kembali</x-secondary-link>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
