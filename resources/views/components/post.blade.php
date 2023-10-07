@props(['post'])

<article
    class="transition-colors duration-300 hover:bg-gray-100 border border-black border-opacity-0 hover:border-opacity-5 rounded-xl">
    <div class="py-8 px-6 flex flex-col">
        <div class="flex-1">
            <img src="/images/illustration-1.png" alt="Blog Post illustration" class="rounded-xl">
        </div>

        <div class="flex-1 flex flex-col justify-between">
            <header class="mt-8 lg:mt-0">
                <div class="space-x-2 mt-2">
                    <a href="#"
                        class="px-3 py-1 border border-blue-300 rounded-full text-blue-300 text-xs uppercase font-semibold"
                        style="font-size: 10px">{{ $post->category->name }}</a>
                </div>

                <div class="my-2">
                    <h1 class="text-lg font-semibold">
                        {{ $post->title }}
                    </h1>

                    <span class="block text-gray-400 text-xs">
                        <p>Published <time>{{ $post->published_at->diffForHumans() }}</time></p>
                    </span>
                </div>
            </header>

            <p class="text-sm">
                {{ $post->body }}
            </p>

            <footer class="flex justify-between items-center mt-8">
                <x-user-profile :username="$post->user->username" />

                <div class="hidden lg:block">
                    <a href="/posts/{{ $post->id }}"
                        class="transition-colors duration-300 text-xs font-semibold bg-gray-200 hover:bg-gray-300 rounded-full py-2 px-8">
                        Read More
                    </a>
                </div>
            </footer>
        </div>
    </div>
</article>
