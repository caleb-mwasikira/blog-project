<nav class="md:flex md:justify-between md:items-center sm:px-6 sm:py-4">
    <div>
        <a href="{{ route('home') }}">
            <img src="/images/logo.svg" alt="Laracasts Logo" width="165" height="16">
        </a>
    </div>

    <div class="mt-8 md:mt-0 flex space-x-4 items-center">
        @auth
            <a href="{{ route('view-create-post') }}" class="text-xs font-semibold uppercase hover:text-blue-500">Create Post</a>
            <a href="{{ route('view-my-posts') }}" class="text-xs font-semibold uppercase hover:text-blue-500">My Posts</a>
        @endauth

        <a href="{{ route('view-all-posts') }}" class="text-xs font-semibold uppercase hover:text-blue-500">
            View Posts
        </a>

        @guest
            <a href="{{ route('register') }}" class="text-xs font-semibold uppercase hover:text-blue-500">Register</a>

            <a href="{{ route('login') }}"
                class="bg-blue-500 ml-3 rounded-full text-sm font-semibold text-white uppercase py-2 px-4">
                Sign In
            </a>
        @endguest

        @auth
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="bg-blue-500 rounded-full text-sm font-semibold text-white uppercase py-2 px-4">
                    Logout
                </button>
            </form>
        @endauth
    </div>
</nav>
