@props([
    "username" => "Unknown",
    "title" => "Author"
])

<div class="flex text-sm mt-4">
    <img class="object-cover object-center w-10 h-10 rounded-full" 
        src="/images/lary-avatar.svg" 
        alt="User profile">
    
    <div class="ml-3 text-left">
        <p class="text-sm text-gray-700 dark:text-gray-200 w-32">{{ $username }}</p>
        <p class="text-xs text-gray-500 dark:text-gray-400">{{ $title }}</p>
    </div>
</div>
