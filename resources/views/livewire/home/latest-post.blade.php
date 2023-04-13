<div>
    <div class="post-container">

        {{-- Latest Post --}}
        @foreach ($posts as $post)
            <x-posts.latest :post="$post" />
        @endforeach

    </div>

    <div class="flex justify-center my-16">
        @if ($posts->hasMorePages())
            <x-jet-button wire:click="loadMore">
                Load More
                <div wire:loading>
                    ...
                </div>
            </x-jet-button>
        @else
            <x-jet-button class="hover:bg-theme-blue-200">
                No More Posts
            </x-jet-button>
        @endif
    </div>
</div>
