<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            Hak Akses
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-6">
                        <x-primary-link href="{{ route('permission.create') }}">Tambah Hak Akses</x-primary-link>
                    </div>

                    <x-table>
                        <x-table.thead>
                            <x-table.tr>
                                <x-table.th>No</x-table.th>
                                <x-table.th>Nama</x-table.th>
                                <x-table.th>Peran</x-table.th>
                                <x-table.th>Pilihan</x-table.th>
                            </x-table.tr>
                        </x-table.thead>
                        <x-table.tbody>
                            @foreach ($permissions as $permission)
                            <x-table.tr>
                                <x-table.td class="text-center w-14">{{ $permissions->firstItem() + $loop->index }}</x-table.td>
                                <x-table.td>{{ $permission->name }}</x-table.td>
                                <x-table.td>{{ $permission->roles->implode('name', ', ') }}</x-table.td>
                                <x-table.td class="w-48">
                                    <div class="flex justify-center space-x-2">
                                        <x-secondary-link href="{{ route('permission.edit', $permission) }}">Edit</x-secondary-link>
                                        <x-danger-button onclick="deleteData({
                                            'data': {{ $permission }},
                                            'dataName': '{{ $permission->name }}',
                                            'url' : '{{ route('permission.destroy', $permission) }}'
                                        })">Hapus</x-danger-button>
                                    </div>
                                </x-table.td>
                            </x-table.tr>
                            @endforeach
                        </x-table.tbody>
                    </x-table>
                    
                    @if ($permissions->hasPages())
                    <div class="mt-4">
                        {{ $permissions->links() }}
                    </div>                    
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>