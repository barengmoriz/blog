<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Image') }}
        </h2>

        <form class="flex flex-col space-y-4" method="post" action="{{ route('profile.image.upload') }}" enctype="multipart/form-data">
            @csrf
            @method('put')

            <img class="object-cover rounded-full size-28" src="{{ $user->image ? Storage::url($user->image) : Avatar::create($user->name)->toBase64() }}" alt="" srcset="">
            <x-text-input type="file" accept=".jpg, .jpeg, .png" id="image" name="image" class="shadow-none focus:outline-none" />
            <x-input-error class="mt-2" :messages="$errors->get('image')" />
            <div class="space-x-2">
                <x-primary-button class="w-fit">Upload</x-primary-button>
                <x-danger-button class="w-fit" onclick="deleteData({
                    'data': {{ $user }},
                    'dataName': '{{ $user->image }}',
                    'url' : '{{ route('profile.image.destroy') }}',
                    'message' : 'Apakah Anda Yakin Data Gambar Akan Dihapus ?'
                })">Remove</x-danger-button>
            </div>
        </form>
    </header>
</section>