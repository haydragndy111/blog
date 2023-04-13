<x-admin-layout>
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/choices.css') }}">
@endpush

    {{-- Header --}}
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-white">
            {{ __('Posts: Create') }}
        </h2>
    </x-slot>

    <section class="mx-6">
        <div class="p-8">
            <x-form action="{{ route('admin.posts.store') }}" has-files>
                <div class="space-y-8">

                    {{-- Cover Image --}}
                    <div>
                        <x-form.label for="image" value="{{ __('Cover Image') }}" />
                        <x-form.input id="image" class="block w-full mt-1" type="file" name="image" required />
                        {{-- <x-form.error for="image" /> --}}
                    </div>

                    {{-- Title --}}
                    <div>
                        <x-form.label for="title" value="{{ __('Title') }}" />
                        <x-form.input id="title" class="block w-full mt-1" type="text" name="title"
                        :value="old('title')" required autofocus />
                        {{-- <x-form.error for="title" /> --}}
                    </div>

                    {{-- Body --}}
                    <div>
                        <x-form.label for="body" value="{{ __('Content') }}" />
                        <x-trix name="body">
                        </x-trix>
                        {{-- <x-form.error name="body" /> --}}
                    </div>

                    {{-- Published At --}}
                    <div>
                        <x-form.label for="published_at" value="{{ __('Published At') }}" />
                        <x-pikaday name="published_at" format="YYYY-MM-DD" />
                        {{-- <x-form.error for="published_at" /> --}}
                    </div>

                    {{-- Type --}}
                    <div>
                        <x-form.label for="type" value="{{ __('Type') }}" />
                        <select name="type" id="type" class="w-full text-sm border-gray-300 rounded-md shadow-sm focus:border-blue-300
                                    focus:ring-blue-200 focus:ring-opacity-50">
                            <option value="standard">Standard</option>
                            <option value="premium">Premium</option>
                        </select>
                        {{-- <x-form.error for="type" /> --}}
                    </div>

                    {{-- Tags --}}
                    <div>
                        <x-form.label for="tags" value="{{ __('Tags') }}" />
                        <select name="tags[]" id="tags" x-data="{}"
                            x-init="function(){choices($el)}" multiple>
                            @foreach ($tags as $tag)
                                <option value="{{ $tag->id() }}">
                                    {{ $tag->name() }}
                                </option>
                            @endforeach
                        </select>
                        {{-- <x-form.error for="tags" /> --}}
                    </div>

                    {{-- Photo Credit Text --}}
                    <div>
                        <x-form.label for="photo_credit_text" value="{{ __('Photo Credit Text') }}" />
                        <x-form.input id="photo_credit_text" class="block w-full mt-1" type="text" name="photo_credit_text"
                        :value="old('photo_credit_text')"/>
                        {{-- <x-form.error for="photo_credit_text"/> --}}
                    </div>

                    {{-- Photo Credit Link --}}
                    <div>
                        <x-form.label for="photo_credit_link" value="{{ __('Photo Credit Link') }}" />
                        <x-form.input id="photo_credit_link" class="block w-full mt-1" type="text" name="photo_credit_link"
                        :value="old('photo_credit_link')"/>
                        {{-- <x-form.error for="photo_credit_link"/> --}}
                    </div>

                    {{-- Disable Comments --}}
                    <div class="">
                        <x-checkbox name="is_commentable" value="1" />
                        <span class="text-xs font-semibold text-blue-500 uppercase">
                            Disable Comments
                        </span>
                        {{-- <x-form.error for="is_commentable"/> --}}
                    </div>

                    {{-- Button --}}
                    <x-buttons.primary>
                        {{ __('Create') }}
                    </x-buttons.primary>
            </x-form>
        </div>
    </section>
</x-admin-layout>
