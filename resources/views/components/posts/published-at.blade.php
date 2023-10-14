@props([
    "publishedAt" => null
])

<span class="block text-gray-400 text-xs mt-2">
    @if (isset($publishedAt))
        <p>Published <time>{{ $publishedAt->diffForHumans() }}</time></p>
    @else
        <p>Not Yet Published</p>
    @endif
</span>