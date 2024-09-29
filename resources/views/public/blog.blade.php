<x-public-layout>
    <div class="space-y-4">
        <div class="text-xl font-bold">
            {{ $blog->title }}
        </div>
        <div>
            <img src="{{ Storage::url($blog->image) }}" alt="" class="object-cover object-center w-full rounded h-fit">
        </div>
        <div class="flex justify-between">
            <div>{{ $blog->user->name }}</div>
            <div>{{ $blog->custom_created_at }}</div>
        </div>
        <div class="flex justify-between">
            <div>{{ $blog->category->name }}</div>
            <div>
                @foreach ($blog->tags as $tag)
                    {{ $tag->name }}
                @endforeach
            </div>
        </div>
        <div>{{ $blog->description }}</div>
    </div>
</x-public-layout>