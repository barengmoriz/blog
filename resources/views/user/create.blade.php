<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            Tambah Pengguna
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('user.store') }}" class="space-y-4" method="post">
                        @csrf
                        <div class="flex flex-col space-y-2">
                            <x-input-label for="name" :value="'Nama'" />
                            <x-text-input type="text" id="name" name="name" value="{{ old('name') }}" />
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        <div class="flex flex-col space-y-2">
                            <x-input-label for="username" :value="'Nama Pengguna'" />
                            <x-text-input type="text" id="username" name="username" value="{{ old('username') }}" />
                        </div>
                        <x-input-error :messages="$errors->get('username')" class="mt-2" />
                        <div class="flex flex-col space-y-2">
                            <x-input-label for="email" :value="'Email'" />
                            <x-text-input type="email" id="email" name="email" value="{{ old('email') }}" />
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        <div class="flex flex-col space-y-2">
                            <x-input-label for="role" :value="'Peran'" />
                            <x-select id="role" name="role">
                                @foreach ($roles as $role)
                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </x-select>
                        </div>
                        <x-input-error :messages="$errors->get('role')" />
                        <div class="flex flex-col space-y-2">
                            <x-input-label for="permissions" :value="'Hak Akses'" />
                            <x-select class="select2" id="permissions" name="permissions[]" multiple>
                                @foreach ($permissions as $permission)
                                <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                                @endforeach
                            </x-select>
                        </div>
                        <x-input-error :messages="$errors->get('permissions')" />
                        <div class="flex flex-col space-y-2">
                            <x-input-label for="password" :value="'Kata Sandi'" />
                            <x-text-input type="text" id="password" name="password" />
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        <div class="mt-2 space-x-1">
                            <x-primary-button>Simpan</x-primary-button>
                            <x-secondary-link href="{{ route('user') }}">Kembali</x-secondary-link>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
