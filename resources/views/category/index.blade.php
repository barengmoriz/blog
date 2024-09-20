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
                        <a href="{{ route('category.create') }}" class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md dark:bg-gray-200 dark:text-gray-800 hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">Tambah Kategori</a>
                    </div>

                    <div class="flex flex-col overflow-hidden border border-gray-300 rounded-md">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-100">
                                <tr class="divide-x">
                                    <th class="w-20 p-2 whitespace-nowrap">No</th>
                                    <th class="p-2 whitespace-nowrap">Slug</th>
                                    <th class="p-2 whitespace-nowrap">Nama</th>
                                    <th class="p-2 whitespace-nowrap">Pilihan</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y">
                                @foreach ($categories as $category)
                                <tr class="divide-x">
                                    <td class="px-2 py-3 text-center whitespace-nowrap">{{ $categories->firstItem() + $loop->index }}</td>
                                    <td class="px-2 py-3 whitespace-nowrap">{{ $category->slug }}</td>
                                    <td class="px-2 py-3 whitespace-nowrap">{{ $category->name }}</td>
                                    <td class="px-2 py-3 text-center whitespace-nowrap"><a href="{{ route('category.edit', $category->id) }}" class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-gray-700 uppercase transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md shadow-sm dark:bg-gray-800 dark:border-gray-500 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25">Edit</a></td>
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