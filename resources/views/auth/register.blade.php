@section('title', 'Create New Account')

<x-layout>
    <main class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <h2 class="mt-5 text-center text-2xl leading-9 tracking-tight text-gray-900">
            Create a new account
        </h2>

        <div class="mt-5 sm:mx-auto sm:w-full sm:max-w-sm">
            <form action="/register" method="POST">
                @csrf
                <div class="space-y-2">
                    <div>
                        <label for="username" class="block text-sm font-medium leading-6 text-gray-900">
                            Username
                        </label>
                        <div class="mt-2">
                            <input id="username" name="username" type="text" placeholder="Enter your username"
                                value="{{ old('username') }}" required
                                class="block w-full rounded-md border-0 px-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">

                            @error('username')
                                <div class="text-xs text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium leading-6 text-gray-900">
                            Email address
                        </label>
                        <div class="mt-2">
                            <input id="email" name="email" type="email" placeholder="Enter your email"
                                autocomplete="email" value="{{ old('email') }}" required
                                class="block w-full rounded-md border-0 px-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">

                            @error('email')
                                <div class="text-xs text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium leading-6 text-gray-900">
                            Password
                        </label>

                        <div class="mt-2">
                            <input id="password" name="password" type="password" placeholder="********" required
                                class="block w-full rounded-md border-0 px-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">

                            @error('password')
                                <div class="text-xs text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <button type="submit"
                    class="flex w-full justify-center rounded-full bg-indigo-600 mt-8 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    Create Account
                </button>
            </form>

            <p class="text-center text-sm text-gray-500 font-mono">
                Already have an account?
                <a href="{{ route('login') }}" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">
                    Login to your account
                </a>
            </p>
        </div>
    </main>
</x-layout>
