<div>
    <div class="mb-2">Semua Tag</div>
    <div class="grid grid-cols-2 gap-2">
        @foreach ($tags as $tag)
            <x-primary-link class="justify-center">{{ $tag->name }}</x-primary-link>
        @endforeach
    </div>
</div>