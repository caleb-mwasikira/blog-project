@props(['postId', 'comments' => []])

<div class="max-w-4xl mx-auto lg:grid lg:grid-cols-12 gap-x-10" id="comments">
    <h1 class="col-span-12 mt-2 text-sm font-semibold uppercase">
        Comments Section
    </h1>

    <x-comments.add :postId="$postId" />

    @if ($comments->isEmpty())
        <div class="col-span-12 bg-white dark:bg-gray-900 mt-12 text-center">
            <p class="text-center text-sm">There are no comments for this post</p>
        </div>
    @else
        @foreach ($comments as $comment)
            @php
                $highlightComment = $comment->user->id == Auth::user()->id;
            @endphp

            <div
                class="relative col-span-8 mt-4 p-4 rounded-lg {{ $highlightComment ? 'bg-gray-100 hover:bg-gray-200' : 'bg-white' }}">
                {{--  --}}

                <x-user-profile :user="$comment->user" />

                <p class="mt-2 justify-end text-sm text-gray-500 md:text-sm">
                    {{ $comment->body }}
                </p>
            </div>
        @endforeach
    @endif
</div>
