@props([
    'comments' => [],
])

<div class="max-w-4xl mx-auto lg:grid lg:grid-cols-12 gap-x-10">
    <h1 class="col-span-12 mt-10 text-sm font-semibold uppercase">
        Comments Section
    </h1>

    @if ($comments->isEmpty())
        <div class="col-span-12 bg-white dark:bg-gray-900 mt-12 text-center">
            <p class="text-center text-sm">There are no comments for this post</p>
        </div>
    @else
        @foreach ($comments as $comment)
            <div class="col-span-8 bg-white dark:bg-gray-900 mt-6">
                <x-user-profile :user="$comment->user" />

                <p class="mt-3 w-3/4 justify-end text-sm text-gray-500 md:text-sm">
                    {{ $comment->body }}
                </p>
            </div>
        @endforeach
    @endif
</div>
