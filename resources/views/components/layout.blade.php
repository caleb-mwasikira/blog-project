<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Blog App')</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="/css/index.css">

    <!-- CSS src="https://cdn.tailwindcss.com" -->
    <link rel="stylesheet" href="/css/tailwind.min.css">

    <!-- AlpineJS src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" -->
    <script defer src="/js/alpine.js"></script>
</head>

<body class="px-6 py-8">

    @include('partials.navbar')

    {{ $slot }}

    <footer class="bg-gray-100 border border-black border-opacity-5 rounded-xl text-center py-16 px-10 mt-16">
        <img src="/images/lary-newsletter-icon.svg" alt="" class="mx-auto -mb-6" style="width: 145px;">
        <h5 class="text-3xl">Stay in touch with the latest posts</h5>
        <p class="text-sm mt-3">Promise to keep the inbox clean. No bugs.</p>

        <div class="mt-10">
            <div class="relative inline-block mx-auto lg:bg-gray-200 rounded-full">

                <form method="POST" action="#" class="lg:flex text-sm">
                    <div class="lg:py-3 lg:px-5 flex items-center">
                        <label for="email" class="hidden lg:inline-block">
                            <img src="/images/mailbox-icon.svg" alt="mailbox letter">
                        </label>

                        <input id="email" type="text" placeholder="Your email address"
                            class="lg:bg-transparent py-2 lg:py-0 pl-4 focus-within:outline-none">
                    </div>

                    <button type="submit"
                        class="transition-colors duration-300 bg-blue-500 hover:bg-blue-600 mt-4 lg:mt-0 lg:ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-8">
                        Subscribe
                    </button>
                </form>
            </div>
        </div>
    </footer>

    {{-- AlpineJS code hides the success flash message after n seconds --}}
    @if (session('success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 8000)" x-show="show"
            class="absolute bottom-5 right-5 text-white text-bold text-sm px-2 py-2 text-center rounded-sm bg-blue-500">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    {{-- AlpineJS code hides the fail flash message after n seconds --}}
    @if (session('fail'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 8000)" x-show="show"
            class="absolute bottom-5 right-5 text-white text-bold text-sm px-2 py-2 text-center rounded-sm bg-red-500">
            <p>{{ session('fail') }}</p>
        </div>
    @endif
</body>

</html>
