<x-guest-layout>

    <section class="container pt-16 mx-auto mb-32">

        {{-- Header --}}
        <header class="flex flex-col py-8 mt-8 mb-12 space-y-6 text-center">
            <h2 class="font-serif text-5xl font-bold">Checkout</h2>
            <hr class="self-center w-40 border-b-4 border-theme-blue-200">
        </header>

        <div class="flex flex-col items-center max-w-4xl mx-auto">
            <div class="w-full p-10 m-4 leading-loose border border-gray-200 shadow-lg bg-gray-50">
                {{-- Payment Form --}}
                <form id="payment-form" class="space-y-8" action="{{ route('payments.store') }}" method="POST">
                    <h2 class="relative font-serif text-xl font-bold">
                        <span class="side-title">
                            Customer information
                        </span>
                    </h2>

                    {{-- Plan --}}
                    <input type="hidden" name="plan" id="plan" value="{{ request('plan') }}">

                    {{-- Payment Method --}}
                    <input type="hidden" name="payment-method" id="payment-method">

                    {{-- Name --}}
                    <div class="space-y-2">
                        <x-jet-label for="name" value="{{ __('Name') }}" />
                        <x-jet-input id="name" class="block w-full mt-1" type="text" name="name" :value="{{ auth()->user()->name() }}"  autocomplete="name" />
                    </div>

                    {{-- Email --}}
                    <div class="space-y-2">
                        <x-jet-label for="email" value="{{ __('Email') }}" />
                        <x-jet-input id="email" class="block w-full mt-1" type="text" name="email" :value="{{ auth()->user()->emailAddress() }}"  autocomplete="email" />
                    </div>

                    {{-- Address --}}
                    {{-- Line 1 --}}
                    <div class="space-y-2">
                        <x-jet-label for="line1" value="{{ __('Street, PO Box, or company name') }}" />
                        <x-jet-input id="line1" class="block w-full mt-1" type="text" name="line1" :value="old('line1')"  autocomplete="address" />
                    </div>

                    {{-- Line 2 --}}
                    <div class="space-y-2">
                        <x-jet-label for="line2" value="{{ __('Apartment, Suite, Unit, or Building') }}" />
                        <x-jet-input id="line2" class="block w-full mt-1" type="text" name="line2" :value="old('line2')"  autocomplete="address" />
                    </div>

                    <div class="space-y-2">
                        <x-jet-label for="city" value="{{ __('City') }}" />
                        <x-jet-input id="city" class="block w-full mt-1" type="text" name="city" :value="old('city')"  autocomplete="city" />
                    </div>

                    <div class="inline-block w-1/2 pr-2 ">
                        <x-jet-label for="country" value="{{ __('Country') }}" />
                        <x-jet-input id="country" class="block w-full mt-1" type="text" name="country" :value="old('country')"  autocomplete="country" />
                    </div>

                    <div class="inline-block w-1/2 pl-2 -mx-1">
                        <x-jet-label for="postal_code" value="{{ __('Postal Code / Zip') }}" />
                        <x-jet-input id="postal_code" class="block w-full mt-1" type="text" name="postal_code" :value="old('postal_code')"  autocomplete="zip" />
                    </div>

                    <h2 class="relative font-serif text-xl font-bold">
                        <span class="side-title">
                            Payment information
                        </span>
                    </h2>

                    <div class="space-y-2">
                        <x-jet-label for="card_no" value="{{ __('Card Number') }}" />
                        <x-jet-input id="card_no" class="block w-full mt-1" type="text" name="card_no" :value="old('card_no')"  autocomplete="card_no" />
                    </div>

                    <div class="space-y-2">
                        <button class="px-4 py-1 font-light tracking-wider text-white bg-gray-900 rounded" type="submit">
                            Pay Now
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

</x-guest-layout>
