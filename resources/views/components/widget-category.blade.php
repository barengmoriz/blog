<div>
    <div class="mb-2">Semua Kategori</div>
    <div class="grid grid-cols-3 gap-2">
        @foreach ($categories as $category)
            <x-primary-link class="justify-center" href="{{ route('category.show', $category->slug) }}">{{ $category->name }}</x-primary-link>
        @endforeach
    </div>
</div>