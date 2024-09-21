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
                    <div class="mb-6">
                        <x-primary-link href="{{ route('category.create') }}">Tambah Kategori</x-primary-link>
                    </div>

                    @if(session('message'))
                    <div x-data="{ open: true }">
                        <div @click="open = ! open" x-show="open" class="w-full p-3 mb-6 text-white bg-green-500 rounded-md">
                            {{ session('message') }}
                        </div>
                    </div>
                    @endif

                    <div class="flex flex-col overflow-hidden border border-gray-300 rounded-md">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-100">
                                <tr class="divide-x">
                                    <th class="w-20 p-2 whitespace-nowrap">No</th>
                                    <th class="p-2 whitespace-nowrap">Slug</th>
                                    <th class="p-2 whitespace-nowrap">Nama</th>
                                    <th class="w-20 p-2 whitespace-nowrap">Pilihan</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y">
                                @foreach ($categories as $category)
                                <tr class="divide-x">
                                    <td class="px-2 py-3 text-center whitespace-nowrap">{{ $categories->firstItem() + $loop->index }}</td>
                                    <td class="px-2 py-3 whitespace-nowrap">{{ $category->slug }}</td>
                                    <td class="px-2 py-3 whitespace-nowrap">{{ $category->name }}</td>
                                    <td class="px-2 py-3 text-center whitespace-nowrap">
                                        <div class="flex justify-center space-x-2">
                                            <x-secondary-link href="{{ route('category.edit', $category) }}">Edit</x-secondary-link>
                                            <form action="{{ route('category.destroy', $category) }}" onsubmit="return confirm('Apakah Anda Yakin Data {{ $category->name }} Akan Dihapus?')" method="post">
                                                @csrf
                                                @method('delete')
                                                <x-danger-button>Hapus</x-danger-button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class={{ $categories->hasPages() ? "mt-4" : "" }}>
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>