<x-public-layout>
    <div class="flex items-center justify-center mb-6 text-3xl font-bold underline">Blog</div>
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        @foreach ($blogs as $blog)
        <div class="space-y-2">
            <div>
                <a href="{{ route('blog.show', $blog) }}"><img src="{{ Storage::url($blog->image) }}" alt="" class="object-cover object-center w-full h-48 rounded"></a>
            </div>
            <div>
                <a href="{{ route('blog.show', $blog) }}" class="duration-300 hover:text-red-500 line-clamp-1">{{ $blog->title }}</a>
            </div>
        </div>
        @endforeach
    </div>
</x-public-layout>