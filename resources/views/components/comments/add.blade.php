@props(['postId'])

{{-- Add comment section --}}
<div class="col-span-8 bg-white dark:bg-gray-900 my-4" x-data="{ show: false }">
    @guest
        <div class="w-full bg-white dark:bg-gray-900 mt-4 text-center">
            <p class="text-left text-sm font-mono">
                Please
                <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-500">
                    login
                </a>
                to comment on this post
            </p>
        </div>
    @endguest

    @auth
        <div class="flex justify-between items-center p-4">
            <x-user-profile :user="Auth::user()" />

            <button type="button" x-on:click="show = true"
                class="transition-colors duration-300 bg-blue-500 hover:bg-blue-600 rounded-full text-xs font-semibold text-white uppercase py-2 px-4">
                Comment On This Post
            </button>
        </div>

        <form action="{{ route('create-comment', ['post' => $postId]) }}" method="post" x-show="show"
            x-on:click.away="show = false" x-cloak x-transition class="p-4">
            @csrf
            <div class="col-span-8 my-2">
                <label for="body" class="block text-sm text-gray-500 dark:text-gray-300">
                    Add a comment
                </label>

                <textarea name="body" placeholder="Write your comment here" minlength="1" required
                    class="block mt-2 w-full leading-0 font-mono text-sm placeholder-gray-400/70 dark:placeholder-gray-500 rounded-lg border border-gray-200 bg-white px-3 h-32 py-2.5 text-gray-700 focus:border-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-40 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-blue-300">{{ old('body') }}</textarea>

                <p class="mt-2 text-xs text-gray-400 dark:text-gray-600">
                    A minimum of 1 character(s) required to comment on a post
                </p>

                @error('body')
                    <p class="text-xs text-red-400 font-semibold">{{ $message }}</p>
                @enderror
            </div>

            <div class="col-span-8 flex justify-end">
                <button type="submit"
                    class="transition-colors duration-300 bg-blue-500 hover:bg-blue-600 rounded-full text-xs font-semibold text-white uppercase py-2 px-4">
                    Send
                </button>
            </div>
        </form>
    @endauth
</div>
