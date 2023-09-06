<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Posts</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <section class="bg-white dark:bg-gray-900">
        <div class="container px-6 py-10 mx-auto">
            <div class="flex items-center justify-between mb-12">
                <h1 class="text-lg text-gray-800 lg:text-xl dark:text-white">
                    Published Posts
                </h1>

                <button class="focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-6 h-6 text-gray-600 transition-colors duration-300 transform dark:text-gray-400 hover:text-blue-500"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
            </div>

            <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
                @foreach ($posts as $post)
                    <div>
                        <img class="object-cover object-center w-full h-64 rounded-lg lg:h-80"
                            src="{{ $post->img_src ?? 'https://via.placeholder.com/640x480.png' }}" alt="" />

                        <div class="p-4">
                            <div class="flex items-center justify-between mt-4">
                                <div>
                                    <a href="#"
                                        class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:underline hover:text-gray-500">
                                        {{ $post->user->username }}
                                    </a>

                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                        {{ $post->published_at->format("M d Y") }}
                                    </p>
                                </div>
                                <span class="text-blue-500 text-sm">{{ $post->category->name }}</span>
                            </div>

                            <h1 class="mt-4 text-xl font-semibold text-gray-800 dark:text-white">
                                {{ $post->title }}
                            </h1>


                            <p class="mt-2 text-gray-500 dark:text-gray-400">
                                {{ $post->body }}
                            </p>

                            <a href={{ 'posts/' . $post->id }}
                                class="mt-4 flex justify-end inline-block text-blue-500 text-sm underline hover:text-blue-400">
                                Read More
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</body>

</html>
