<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            Edit Pengguna {{ $user->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form class="flex flex-col space-y-4" method="post" action="{{ route('user.image.upload', $user) }}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        
                        <x-input-label for="image" :value="'Foto Profil'" />
                        <img class="object-cover rounded-full size-28" src="{{ $user->image ? Storage::url($user->image) : Avatar::create($user->name)->toBase64() }}" alt="" srcset="">
                        <x-text-input type="file" accept=".jpg, .jpeg, .png" id="image" name="image" class="shadow-transparent focus:outline-none" />
                        <x-input-error class="mt-2" :messages="$errors->get('image')" />
                        <div class="space-x-2">
                            <x-primary-button class="w-fit">Unggah</x-primary-button>
                            <x-danger-button class="w-fit" onclick="deleteData({
                                'data': {{ $user }},
                                'dataName': '{{ $user->image }}',
                                'url' : '{{ route('user.image.destroy', $user) }}',
                                'message' : 'Apakah anda yakin foto profil {{ $user->name }} akan dihapus ?'
                            })">Hapus Foto</x-danger-button>
                        </div>
                    </form>
                    <form action="{{ route('user.update', $user) }}" class="space-y-4" method="post">
                        @csrf
                        @method('put')
                        <div class="flex flex-col space-y-2">
                            <x-input-label for="name" :value="'Nama'" />
                            <x-text-input type="text" id="name" name="name" value="{{ $user->name }}" />
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        <div class="flex flex-col space-y-2">
                            <x-input-label for="username" :value="'Nama Pengguna'" />
                            <x-text-input type="text" id="username" name="username" value="{{ $user->username }}" />
                        </div>
                        <x-input-error :messages="$errors->get('username')" class="mt-2" />
                        <div class="flex flex-col space-y-2">
                            <x-input-label for="email" :value="'Email'" />
                            <x-text-input type="email" id="email" name="email" value="{{ $user->email }}" />
                                <small class="text-gray-500">* Ketika mengubah email, pengguna harus melakukan verifikasi ulang dengan email yang baru</small>
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        <div class="flex flex-col space-y-2">
                            <x-input-label for="is_active" :value="'Status'" />
                            <x-select id="is_active" name="is_active">
                                <option value="1" {{ $user->is_active == true ? 'selected': '' }}>Aktif</option>
                                <option value="0" {{ $user->is_active == false ? 'selected': '' }}>Tidak Aktif</option>
                            </x-select>
                        </div>
                        <x-input-error :messages="$errors->get('username')" class="mt-2" />
                        <div class="flex flex-col space-y-2">
                            <x-input-label for="password" :value="'Kata Sandi'" />
                            <x-text-input type="text" id="password" name="password" />
                            <small class="text-gray-500">* Diisi jika kata sandi ingin diubah</small>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        <div class="mt-2 space-x-1">
                            <x-primary-button>Perbarui</x-primary-button>
                            <x-secondary-link href="{{ route('user') }}">Kembali</x-secondary-link>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>