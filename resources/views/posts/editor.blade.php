@props([
    'post' => null,
])
@section('title', 'Post Editor')

<x-layout>
    <main class="px-6 py-8 max-w-6xl mx-auto mt-8 space-y-6">
        <article class="mx-auto lg:grid lg:grid-cols-12 gap-x-10">
            <div class="col-span-4 lg:text-center lg:pt-14 mb-10">
                <img src="/images/illustration-1.png" alt="" class="rounded-xl">

                <x-posts.published-at :publishedAt="$post?->published_at" />
                <x-user-profile :user="Auth::user()" />
            </div>

            <form action="{{ route('post-editor') }}" method="POST" class="col-span-8 w-4/5 mt-12 mx-auto">
                @csrf
                <x-posts.editor-controls :post="$post" />

                <div class="grid gap-x-8 gap-y-6">
                    <div class="col-span-12">
                        <x-category-dropdown-input :selectedCategory="$post?->category->name" />
                    </div>

                    <div class="col-span-12">
                        <label for="title" class="block text-sm text-gray-500 dark:text-gray-300">
                            Title
                        </label>

                        <input type="text" name="title" placeholder="Enter post title"
                            value="{{ old('title') ?? $post?->title }}" required
                            class="block mt-2 w-full text-sm font-mono placeholder-gray-500 dark:placeholder-gray-500 rounded-lg border bg-white px-3 py-2.5 text-gray-700 focus:outline-none focus:ring dark:bg-gray-900 dark:text-gray-300" />

                        @error('title')
                            <p class="text-xs text-red-400 font-semibold">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-span-12">
                        <label for="body" class="block text-sm text-gray-500 dark:text-gray-300">
                            Post Body
                        </label>

                        <textarea name="body" placeholder="Write your post here" minlength="50" required
                            class="block mt-2 w-full text-sm leading-0 font-mono placeholder-gray-500 dark:placeholder-gray-500 rounded-lg border border-gray-200 bg-white px-3 h-32 py-2.5 text-gray-700 focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-blue-300">{{ old('body') ?? trim($post?->body) }}</textarea>

                        <p class="mt-2 text-xs text-gray-400 dark:text-gray-600">
                            A minimum of 50 characters required to publish a post
                        </p>

                        @error('body')
                            <p class="text-xs text-red-400 font-semibold">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </form>
        </article>
    </main>
</x-layout>
