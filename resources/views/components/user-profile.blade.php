@props(['user'])

<div class="flex text-sm mt-4">
    <img class="object-cover object-center w-10 h-10 rounded-full"
        src="/images/lary-avatar.svg" alt="User profile">

    <div class="ml-3 text-left">
        <p class="text-xs text-gray-700 dark:text-gray-200 w-32">{{ ucwords($user->username ?? 'Anon') }}</p>
        <p class="text-xs text-gray-500 dark:text-gray-400">{{ ucwords($user->role ?? 'Unknown') }}</p>
    </div>
</div>
