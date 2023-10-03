<nav class="md:flex md:justify-between md:items-center">
    <div>
        <a href="/">
            <img src="/images/logo.svg" alt="Laracasts Logo" width="165" height="16">
        </a>
    </div>

    <div class="mt-8 md:mt-0 flex space-x-4 items-center">
        @auth
            <p class="text-xs font-semibold uppercase mr-5">Welcome back, {{ Auth::user()->username }}</p>
        @endauth

        <a href="/posts" class="text-xs font-semibold uppercase hover:text-blue-500">View Posts</a>

        @guest
            <a href="/register" class="text-xs font-semibold uppercase hover:text-blue-500">Register</a>

            <a href="/login" class="bg-blue-500 ml-3 rounded-full text-sm font-semibold text-white uppercase py-2 px-4">
                Sign In
            </a>
        @endguest

        @auth
            <form action="/logout" method="POST">
                @csrf
                <button type="submit"
                    class="bg-blue-500 rounded-full text-sm font-semibold text-white uppercase py-2 px-4">
                    Logout
                </button>
            </form>
        @endauth
    </div>
</nav>
