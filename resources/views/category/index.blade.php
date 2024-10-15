<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            Kategori
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @can('Kategori Tambah')
                    <div class="mb-6">
                        <x-primary-link href="{{ route('category.create') }}">Tambah Kategori</x-primary-link>
                    </div>
                    @endcan

                    <x-table>
                        <x-table.thead>
                            <x-table.tr>
                                <x-table.th>No</x-table.th>
                                <x-table.th>Slug</x-table.th>
                                <x-table.th>Nama</x-table.th>
                                <x-table.th>Pilihan</x-table.th>
                            </x-table.tr>
                        </x-table.thead>
                        <x-table.tbody>
                            @foreach ($categories as $category)
                            <x-table.tr>
                                <x-table.td class="text-center w-14">{{ $categories->firstItem() + $loop->index }}</x-table.td>
                                <x-table.td>{{ $category->slug }}</x-table.td>
                                <x-table.td>{{ $category->name }}</x-table.td>
                                <x-table.td class="w-48">
                                    <div class="flex justify-center space-x-2">
                                        @can('Kategori Edit')
                                        <x-secondary-link href="{{ route('category.edit', $category) }}">Edit</x-secondary-link>
                                        @endcan
                                        @can('Kategori Hapus')
                                        <x-danger-button onclick="deleteData({
                                            'data': {{ $category }},
                                            'dataName': '{{ $category->name }}',
                                            'url' : '{{ route('category.destroy', $category) }}'
                                        })">Hapus</x-danger-button>
                                        @endcan
                                    </div>
                                </x-table.td>
                            </x-table.tr>
                            @endforeach
                        </x-table.tbody>
                    </x-table>
                    
                    @if ($categories->hasPages())
                    <div class="mt-4">
                        {{ $categories->links() }}
                    </div>                    
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>