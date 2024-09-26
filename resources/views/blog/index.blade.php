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

                    <x-table>
                        <x-table.thead>
                            <x-table.tr class="divide-x">
                                <x-table.th>No</x-table.th>
                                <x-table.th>Judul</x-table.th>
                                <x-table.th>Gambar</x-table.th>
                                <x-table.th>Deskripsi</x-table.th>
                                <x-table.th>Kategori</x-table.th>
                                <x-table.th>Tag</x-table.th>
                                <x-table.th>Penulis</x-table.th>
                                <x-table.th>Pilihan</x-table.th>
                            </x-table.tr>
                        </x-table.thead>
                        <x-table.tbody>
                            @foreach ($blogs as $blog)
                            <x-table.tr>
                                <x-table.td class="text-center w-14">{{ $blogs->firstItem() + $loop->index }}</x-table.td>
                                <x-table.td>{{ $blog->title }}</x-table.td>
                                <x-table.td> 
                                    <div class="w-40">
                                        <img src="{{ Storage::url($blog->image) }}" alt="" class="rounded-md">
                                    </div>
                                </x-table.td>
                                <x-table.td>
                                    <div class="w-56 line-clamp-4">
                                        {{ $blog->description }}
                                    </div>
                                </x-table.td>
                                <x-table.td class="text-center">{{ $blog->category->name }}</x-table.td>
                                <x-table.td class="text-center whitespace-nowrap">{{ $blog->tags->implode('name', ', ') }}</x-table.td>
                                <x-table.td class="text-center">{{ $blog->user->name }}</x-table.td>
                                <x-table.td>
                                    <div class="flex justify-center space-x-2">
                                        <x-secondary-link href="{{ route('blog.edit', $blog) }}">Edit</x-secondary-link>
                                        <x-danger-button onclick="deleteData({
                                            'data': {{ $blog }},
                                            'dataName': '{{ $blog->title }}',
                                            'url' : '{{ route('blog.destroy', $blog) }}'
                                        })">Hapus</x-danger-button>
                                    </div>
                                </x-table.td>
                            </x-table.tr>
                            @endforeach
                        </x-table.tbody>
                    </x-table>

                    <div class={{ $blogs->hasPages() ? "mt-4" : "" }}>
                        {{ $blogs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>