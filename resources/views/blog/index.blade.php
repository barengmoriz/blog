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
                    @can('Blog Tambah')
                    <div class="mb-6">
                        <x-primary-link href="{{ route('blog.create') }}">Tambah Blog</x-primary-link>
                    </div>
                    @endcan

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
                                <x-table.th>Tayang</x-table.th>
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
                                <x-table.td>{{ $blog->short_description }}</x-table.td>
                                <x-table.td class="text-center">{{ $blog->category->name }}</x-table.td>
                                <x-table.td class="text-center whitespace-nowrap">{{ $blog->tags->implode('name', ', ') }}</x-table.td>
                                <x-table.td class="text-center">{{ $blog->user->name }}</x-table.td>
                                <x-table.td class="text-center">
                                    @if ($blog->is_publish)
                                        <div class="font-bold text-green-500">Tayang</div>
                                    @else
                                        <div class="font-bold text-orange-500">Tidak Tayang</div>
                                    @endif
                                </x-table.td>
                                <x-table.td>
                                    <div class="flex justify-center space-x-2">
                                        @can('Blog Edit')
                                        <x-secondary-link href="{{ route('blog.edit', $blog) }}">Edit</x-secondary-link>
                                        @endcan
                                        @can('Blog Tayang')
                                        @if ($blog->is_publish)
                                        <form method="post" action="{{ route('blog.unpublish', $blog) }}">
                                            @csrf
                                            @method('put')
                                            <x-primary-button class="bg-orange-500 hover:bg-orange-400 focus:bg-orange-400 active:bg-orange-400">Batalkan</x-primary-button>
                                        </form>
                                        @else
                                        <form method="post" action="{{ route('blog.publish', $blog) }}">
                                            @csrf
                                            @method('put')
                                            <x-primary-button class="bg-green-500 hover:bg-green-400 focus:bg-green-400 active:bg-green-400">Tampilkan</x-primary-button>
                                        </form>
                                        @endif 
                                        @endcan
                                        @can('Blog Hapus')                                   
                                        <x-danger-button onclick="deleteData({
                                            'data': {{ $blog }},
                                            'dataName': '{{ $blog->title }}',
                                            'url' : '{{ route('blog.destroy', $blog) }}'
                                            })">Hapus</x-danger-button>
                                        @endcan
                                    </div>
                                </x-table.td>
                            </x-table.tr>
                            @endforeach
                        </x-table.tbody>
                    </x-table>

                    @if ($blogs->hasPages())
                    <div class="mt-4">
                        {{ $blogs->links() }}
                    </div>                    
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>