<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            Blog
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-6">
                        <x-primary-link href="{{ route('blog.create') }}">Tambah Blog</x-primary-link>
                    </div>

                    <div class="flex flex-col overflow-hidden overflow-x-auto border border-gray-300 rounded-md">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-100">
                                <tr class="divide-x">
                                    <th class="w-20 p-2 whitespace-nowrap">No</th>
                                    <th class="p-2 whitespace-nowrap">Judul</th>
                                    <th class="p-2 whitespace-nowrap">Gambar</th>
                                    <th class="p-2 whitespace-nowrap">Deskripsi</th>
                                    <th class="p-2 whitespace-nowrap">Kategori</th>
                                    <th class="p-2 whitespace-nowrap">Penulis</th>
                                    <th class="w-20 p-2 whitespace-nowrap">Pilihan</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y">
                                @foreach ($blogs as $blog)
                                <tr class="divide-x">
                                    <td class="px-2 py-3 text-center whitespace-nowrap">{{ $blogs->firstItem() + $loop->index }}</td>
                                    <td class="px-2 py-3">{{ $blog->title }}</td>
                                    <td class="px-2 py-3">
                                        <img src="{{ Storage::url($blog->image) }}" alt="">
                                    </td>
                                    <td class="px-2 py-3">
                                        <div class="w-56 line-clamp-4">
                                            {{ $blog->description }}
                                        </div>
                                    </td>
                                    <td class="px-2 py-3">{{ $blog->category->name }}</td>
                                    <td class="px-2 py-3">{{ $blog->user->name }}</td>
                                    <td class="px-2 py-3 text-center whitespace-nowrap">
                                        <div class="flex justify-center space-x-2">
                                            <x-secondary-link href="{{ route('blog.edit', $blog) }}">Edit</x-secondary-link>
                                            <x-danger-button onclick="deleteData({
                                                'data': {{ $blog }},
                                                'dataName': '{{ $blog->title }}',
                                                'url' : '{{ route('blog.destroy', $blog) }}'
                                            })">Hapus</x-danger-button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class={{ $blogs->hasPages() ? "mt-4" : "" }}>
                        {{ $blogs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>