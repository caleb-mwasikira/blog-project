@props(['posts'])
@section("title", "View Posts")

<x-layout>
    <main class="max-w-6xl mx-auto mt-8 space-y-6">
        @if ($posts->isEmpty())
            <p class="text-center text-sm">No posts here. Please try again later</p>
        @else
            <div class="grid">
                @php
                    $featuredPost = $posts->first();
                    $posts = $posts->slice(1);
                    $count = 0;
                @endphp

                <x-posts.featured :post="$featuredPost" />

                @while (!$posts->isEmpty())
                    @if ($count % 2 !== 0)
                        @php
                            $postsSection = $posts->splice(0, 2);
                        @endphp

                        <div class="lg:grid lg:grid-cols-2">
                            @foreach ($postsSection as $post)
                                <x-posts.card :post="$post" />
                            @endforeach
                        </div>
                    @else
                        @php
                            $postsSection = $posts->splice(0, 3);
                        @endphp

                        <div class="lg:grid lg:grid-cols-3">
                            @foreach ($postsSection as $post)
                                <x-posts.card :post="$post" />
                            @endforeach
                        </div>
                    @endif

                    @php
                        $count++;
                    @endphp
                @endwhile
            </div>
        @endif
    </main>
</x-layout>
