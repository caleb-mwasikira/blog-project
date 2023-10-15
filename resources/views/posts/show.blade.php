@props([
    'post' => null,
])
@section('title', $post->title)

<x-layout>
    <main class="px-6 py-8 max-w-6xl mx-auto mt-8 space-y-6">
        @empty($post)
            <p class="text-center text-sm">No posts here. Please try again later</p>
        @endempty

        @isset($post)
            @php
                $isViewingOwnPost = $post->user_id == Auth::user()?->id;
            @endphp

            <article class="max-w-4xl mx-auto lg:grid lg:grid-cols-12 gap-x-10">
                <div class="col-span-4 lg:text-center lg:pt-14 mb-10">
                    <img src="/images/illustration-1.png" alt="" class="rounded-xl">

                    <x-posts.published-at :publishedAt="$post->published_at" />
                    <x-user-profile :user="$post->user" />
                </div>

                <div class="col-span-8">
                    @can('update', $post)
                        <div class="mb-8">
                            <a href="{{ route('view-edit-post', ['post' => $post->id]) }}"
                                class="px-3 py-1 border border-red-500 rounded-full text-red-500 text-xs uppercase font-semibold"
                                style="font-size: 10px">
                                Edit Post
                            </a>
                        </div>
                    @endcan

                    <div class="hidden lg:flex justify-between mb-6">
                        <a href="{{ route('view-all-posts') }}"
                            class="transition-colors duration-300 relative inline-flex items-center text-sm hover:text-blue-500">
                            <svg width="22" height="22" viewBox="0 0 22 22" class="mr-2">
                                <g fill="none" fill-rule="evenodd">
                                    <path stroke="#000" stroke-opacity=".012" stroke-width=".5" d="M21 1v20.16H.84V1z">
                                    </path>
                                    <path class="fill-current"
                                        d="M13.854 7.224l-3.847 3.856 3.847 3.856-1.184 1.184-5.04-5.04 5.04-5.04z">
                                    </path>
                                </g>
                            </svg>

                            Back to Posts
                        </a>

                        <a href="#"
                            class="px-3 py-1 border border-blue-300 rounded-full text-blue-300 text-xs uppercase font-semibold"
                            style="font-size: 10px">
                            {{ $post->category->name }}
                        </a>
                    </div>

                    <h1 class="font-semibold text-2xl mb-5">
                        {{ $post->title }}
                    </h1>

                    <p class="space-y-4 text-md">
                        {{ $post->body }}
                    </p>
                </div>
            </article>

            @includeWhen($post->is_published, 'components.comments.all', [
                'postId' => $post->id,
                'comments' => $post->comments,
            ])
        @endisset
    </main>
</x-layout>
