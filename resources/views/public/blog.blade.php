<x-public-layout>
    <div class="space-y-4">
        <div class="text-xl font-bold">
            {{ $blog->title }}
        </div>
        <div>
            <img src="{{ Storage::url($blog->image) }}" alt="" class="object-cover object-center w-full rounded h-fit">
        </div>
        <div class="flex justify-between">
            <div class="flex items-center space-x-2">
                <img class="object-cover rounded-full size-8" src="{{ $blog->user->image ? Storage::url($blog->user->image) : Avatar::create($blog->user->name)->toBase64() }}" alt="">
                <div>{{ $blog->user->name }}</div>
            </div>
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
        <div class="prose max-w-none">{!! $blog->description !!}</div>
    </div>
</x-public-layout>