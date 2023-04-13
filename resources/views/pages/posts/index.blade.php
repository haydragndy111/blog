<x-guest-layout>
    <x-slot name="header">
        <x-slot name="title">
            {{ __('Decor') }}
        </x-slot>

        <x-slot name="sub">
            <div class="flex flex-col space-y-8">
                {{-- Details --}}
                <div class="flex space-x-2">
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit non facere eius alias temporibus quaerat quae debitis, corrupti nesciunt porro aperiam? Ea odio error, magnam ipsum aliquid nisi facilis alias!
                    </p>
                </div>
            </div>
        </x-slot>

        <x-slot name="image">
            <img class="max-w-xl" src="{{ asset('img/tags/decor.jpg') }}" alt="Decor">
        </x-slot>
    </x-slot>

    <section class="container mx-auto">

        <header class="flex flex-col py-8 mt-8 mb-12 space-y-8 text-center">
            <h2 class="font-serif text-4xl font-bold">Latest posts</h2>
            <hr class="self-center w-40 border-b-4 border-theme-blue-200">
        </header>

        <livewire:home.latest-post :posts='$posts'>

    </section>

</x-guest-layout>
