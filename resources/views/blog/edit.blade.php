<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            Edit Blog {{ $blog->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('blog.update', $blog) }}" method="post" class="space-y-4" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="flex flex-col space-y-2">
                            <label for="title">Judul</label>
                            <x-text-input type="text" id="title" name="title" value="{{ $blog->title }}" />
                        </div>
                        @error('title')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                        <div class="flex flex-col space-y-2">
                            <label for="image">Gambar</label>
                            <img src="{{ Storage::url($blog->image) }}" alt="" class="rounded-lg w-80">
                            <x-text-input type="file" accept=".jpg, .jpeg, .png" id="image" name="image" class="focus:outline-none" />
                        </div>
                        @error('image')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                        <div class="flex flex-col space-y-2">
                            <label for="description">Deskripsi</label>
                            <x-text-area id="description" name="description" rows='6'>{{ $blog->description }}</x-text-area>
                        </div>
                        @error('description')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                        <div class="flex flex-col space-y-2">
                            <label for="category">Kategori</label>
                            <x-select id="category" name="category">
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $category->id == $blog->category_id ? 'selected': '' }}>{{ $category->name }}</option>
                                @endforeach
                            </x-select>
                        </div>
                        @error('category')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                        <div class="flex flex-col space-y-2">
                            <label for="tag">Tag</label>
                            <x-select class="select2" id="tag" name="tag[]" multiple>
                                @foreach ($tags as $tag)
                                <option value="{{ $tag->id }}" {{ $blog->tags()->find($tag->id) ? 'selected': '' }}>{{ $tag->name }}</option>
                                @endforeach
                            </x-select>
                        </div>
                        @error('tag')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                        <div class="mt-2 space-x-1">
                            <x-primary-button>Perbarui</x-primary-button>
                            <x-secondary-link href="{{ route('blog') }}">Kembali</x-secondary-link>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
