<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            Pengguna
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @can('Pengguna Tambah')
                    <div class="mb-6">
                        <x-primary-link href="{{ route('user.create') }}">Tambah Pengguna</x-primary-link>
                    </div>
                    @endcan

                    <x-table>
                        <x-table.thead>
                            <x-table.tr>
                                <x-table.th>No</x-table.th>
                                <x-table.th>Nama</x-table.th>
                                <x-table.th>Nama Pengguna</x-table.th>
                                <x-table.th>Email</x-table.th>
                                <x-table.th>Gambar</x-table.th>
                                <x-table.th>Peran</x-table.th>
                                <x-table.th>Hak Akses</x-table.th>
                                <x-table.th>Status</x-table.th>
                                <x-table.th>Verifikasi</x-table.th>
                                <x-table.th>Pilihan</x-table.th>
                            </x-table.tr>
                        </x-table.thead>
                        <x-table.tbody>
                            @foreach ($users as $user)
                            <x-table.tr>
                                <x-table.td class="text-center w-14">{{ $users->firstItem() + $loop->index }}</x-table.td>
                                <x-table.td>{{ $user->name }}</x-table.td>
                                <x-table.td>{{ $user->username }}</x-table.td>
                                <x-table.td>{{ $user->email }}</x-table.td>
                                <x-table.td>
                                    <div class="flex justify-center">
                                        <img class="object-cover rounded-full size-10" src="{{ $user->image ? Storage::url($user->image) : Avatar::create($user->name)->toBase64() }}" alt="" srcset="">
                                    </div>
                                </x-table.td>
                                <x-table.td>{{ $user->getRoleNames()->implode(',') }}</x-table.td>
                                <x-table.td>{{ $user->getDirectPermissions()->implode('name', ', ') }}</x-table.td>
                                <x-table.td class="text-center">                                        
                                    @if ($user->is_active)
                                        <div class="font-bold text-green-500">Aktif</div>
                                    @else
                                        <div class="font-bold text-orange-500">Tidak Aktif</div>
                                    @endif
                                </x-table.td>
                                <x-table.td class="text-center">
                                    @if ($user->email_verified_at)
                                        <div class="font-bold text-green-500">Terverifikasi</div>
                                    @else
                                        <div class="font-bold text-orange-500">Belum Terverifikasi</div>
                                    @endif</x-table.td>
                                <x-table.td class="w-48">
                                    <div class="flex justify-center space-x-2">
                                        @can('Pengguna Edit')
                                        <x-secondary-link href="{{ route('user.edit', $user) }}">Edit</x-secondary-link>
                                        @endcan
                                        @can('Pengguna Hapus')
                                        <x-danger-button onclick="deleteData({
                                            'data': {{ $user }},
                                            'dataName': '{{ $user->name }}',
                                            'url' : '{{ route('user.destroy', $user) }}'
                                            })">Hapus</x-danger-button>
                                        @endcan
                                    </div>
                                </x-table.td>
                            </x-table.tr>
                            @endforeach
                        </x-table.tbody>
                    </x-table>
                    
                    @if ($users->hasPages())
                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>                    
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>