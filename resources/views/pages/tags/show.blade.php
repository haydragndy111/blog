<x-guest-layout>
    <x-slot name="header">
        <x-slot name="title">
            {{ $tag->name() }}
        </x-slot>

        <x-slot name="sub">
            <div class="flex flex-col space-y-8">
                {{-- Details --}}
                <div class="flex space-x-2">
                    <p>
                        {{ $tag->description }}
                    </p>
                </div>
            </div>
        </x-slot>

        <x-slot name="image">
            <img class="max-w-xl" src="{{ asset('storage/' . $tag->imagePath() )}}" alt="{{ $tag->name }}">
        </x-slot>
    </x-slot>

    <section class="container mx-auto space-y-6 space-x-6">

        <header class="flex flex-col py-8 mt-8 mb-12 space-y-8 text-center">
            <h2 class="font-serif text-4xl font-bold">Posts: {{ $tag->name() }}</h2>
            <hr class="self-center w-40 border-b-4 border-theme-blue-200">
        </header>

        @foreach ($posts as $post)
            <x-posts.latest :post="$post"/>
        @endforeach

        <div class="p-4 my-20 bg-gray-100">
            {{ $posts->links() }}
        </div>

    </section>

</x-guest-layout>
