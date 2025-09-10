<div>
    <div class="mb-2">Semua Tag</div>
    <div class="grid grid-cols-2 gap-2">
        @foreach ($tags as $tag)
            <x-primary-link class="justify-center" href="{{ route('tag.show', $tag->slug) }}">{{ $tag->name }}</x-primary-link>
        @endforeach
    </div>
</div>