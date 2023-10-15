@props([
    'post' => null,
])

@if (is_null($post))
    <p class="text-center text-sm">No featured posts here. Please try again later</p>
@else
    <article
        class="transition-colors duration-300 hover:bg-gray-100 border border-black border-opacity-0 hover:border-opacity-5 rounded-xl mb-10">
        <div class="py-8 px-6 flex flex-col lg:flex-row lg:space-x-4">
            <div class="flex-1">
                <img src="/images/illustration-1.png" alt="Blog Post illustration" class="rounded-xl">
            </div>

            <div class="flex-1 flex flex-col justify-between">
                <header class="mt-8 lg:mt-0">
                    <div class="space-x-2">
                        <a href="#"
                            class="px-3 py-1 border border-blue-300 rounded-full text-blue-300 text-xs uppercase font-semibold"
                            style="font-size: 10px">{{ $post->category->name }}</a>
                    </div>

                    <div class="my-4">
                        <h1 class="text-xl font-semibold">
                            {{ $post->title }}
                        </h1>

                        <x-posts.published-at :publishedAt="$post->published_at" />
                    </div>

                    <p class="text-md">
                        {{ $post->body }}
                    </p>
                </header>

                <footer class="flex justify-between items-center mt-8">
                    <x-user-profile :user="$post->user" />

                    <div class="hidden lg:block">
                        <a href="{{ route('view-post', ['post' => $post->id]) }}"
                            class="transition-colors duration-300 text-xs font-semibold bg-gray-200 hover:bg-gray-300 rounded-full py-2 px-8">
                            Read More
                        </a>
                    </div>
                </footer>
            </div>
        </div>
    </article>
@endif
