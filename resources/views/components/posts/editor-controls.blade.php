@props([
    'post' => null,
])

<div x-data="{ 'isModalOpen': false }" x-on:keydown.escape="isModalOpen=false"
    class="mt-2 mb-10 sm:flex justify-between bg-white border rounded-lg rtl:flex-row-reverse dark:bg-gray-900 dark:border-gray-700">
    @if (is_null($post))
        {{-- Create new post button --}}
        <button type="submit" name="submit_btn" value="new_post"
            class="flex items-center px-4 py-2 text-sm font-medium text-gray-600 transition-colors duration-200 sm:text-base sm:px-6 dark:hover:bg-gray-800 dark:text-gray-300 gap-x-3 hover:bg-gray-100">
            <img src="/icons/add-document.svg" alt="Create New Post Icon" class="w-4 h-4" />
            <span class="text-sm font-semibold">New Post</span>
        </button>
    @endif

    @isset($post)
        <input type="hidden" name="post_id" value="{{ $post->id }}">

        {{-- Update post-data --}}
        <button type="submit" name="submit_btn" value="edit_post"
            class="flex items-center w-full px-4 py-2 text-sm font-medium text-gray-600 transition-colors duration-200 sm:text-base sm:px-6 dark:hover:bg-gray-800 dark:text-gray-300 gap-x-3 hover:bg-gray-100">
            <img src="/icons/disk.svg" alt="View Post Icon" class="w-4 h-4" />
            <span class="text-sm font-semibold">Save</span>
        </button>

        {{-- View post --}}
        <a href="{{ route('view-post', ['post' => $post->id]) }}"
            class="flex items-center w-full px-4 py-2 text-sm font-medium text-gray-600 transition-colors duration-200 sm:text-base sm:px-6 dark:hover:bg-gray-800 dark:text-gray-300 gap-x-3 hover:bg-gray-100">
            <img src="/icons/eye.svg" alt="View Post Icon" class="w-4 h-4" />
            <span class="text-sm font-semibold">View</span>
        </a>

        @if (!$post->is_published)
            {{-- Publish post --}}
            <button type="submit" name="submit_btn" value="publish_post"
                class="flex items-center w-full px-4 py-2 text-sm font-medium text-gray-600 transition-colors duration-200 sm:text-base sm:px-6 dark:hover:bg-gray-800 dark:text-gray-300 gap-x-3 hover:bg-gray-100">
                <img src="/icons/box.svg" alt="Publish Post Icon" class="w-4 h-4" />
                <span class="text-sm font-semibold">Publish</span>
            </button>
        @endif

        {{-- Delete post --}}
        <button x-on:click="isModalOpen = true" type="button" name="submit_btn" value="delete_post"
            class="flex items-center w-full px-4 py-2 text-sm font-medium text-gray-600 transition-colors duration-200 sm:text-base sm:px-6 dark:hover:bg-gray-800 dark:text-gray-300 gap-x-3 hover:bg-gray-100">
            <img src="/icons/trash.svg" alt="Publish Post Icon" class="w-4 h-4" />
            <span class="text-sm font-semibold">Delete</span>
        </button>

        <div role="dialog" tabindex="-1" x-show="isModalOpen" x-on:click.away="isModalOpen = false" x-cloak x-transition
            class="fixed top-0 left-0 z-50 p-4 overflow-x-hidden overflow-y-auto md:inset-0 max-h-full">
            <div class="relative w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <button type="button" x-on:click="isModalOpen=false"
                        class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>

                    <div class="p-6 text-center">
                        <svg class="mx-auto mb-4 text-gray-400 w-8 h-8 dark:text-gray-200" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <div class="mb-5">
                            <p class="text-md text-gray-500 dark:text-gray-400">
                                Are you sure you want to delete this post?
                            <p>
                            <p class="text-sm text-red-500">This action is permanent</p>
                        </div>

                        <div class="sm:flex justify-between items-center">
                            <button type="submit" x-on:click="isModalOpen=false" name="submit_btn" value="delete_post"
                                class="text-white text-bold text-sm px-6 py-2 text-center rounded-full bg-red-600 hover:bg-red-800">
                                Yes, I'm sure
                            </button>

                            <button type="button" x-on:click="isModalOpen=false"
                                class="text-bold text-sm px-6 py-2 text-center rounded-full bg-white hover:bg-gray-100 border">
                                No, cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
</div>
