@extends('layouts.page')

@section('content')

    <div class="w-full bg-cover bg-center bg-no-repeat">

        <div class="container max-w-2xl mx-auto px-4 pt-8 md:pt-16 break-normal">


            <p class="text-4xl text-left font-bold">
                {{ __('Contact us') }}
            </p>

            <p class="text-xl text-left font-semibold text-gray-600">
                {{ __('Send us your thoughts. We will get back to you as soon as possible.') }}
            </p>

            @include('layouts.feedback')

            {{-- Recaptcha Scripting --}}
            <script src="https://www.google.com/recaptcha/api.js" async defer></script>
            <script>
                function onSubmit(token) {
                    document.getElementById("form").submit();
                }
            </script>

            <form class="my-12" action="{{ route('contact.submit') }}" method="post" id="form">

                @csrf

                <div class="mt-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Your name</label>
                    <input
                        type="text"
                        name="name"
                        placeholder="Jane Doe"
                        class="w-full outline-none px-4 py-2 border rounded-lg shadow-sm focus:border-yellow-300 @error('name') border-red-600 @enderror"
                    >
                    @error ('name')
                        <small class="text-xs text-red-600">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <div class="mt-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Your e-mail</label>
                    <input
                        type="text"
                        name="email"
                        placeholder="jdoe@example.com"
                        class="w-full outline-none px-4 py-2 border rounded-lg shadow-sm focus:border-yellow-300 @error('email') border-red-600 @enderror"
                    >
                    @error ('email')
                        <small class="text-xs text-red-600">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <div class="mt-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Subject</label>
                    <input
                        type="text"
                        name="subject"
                        placeholder="Name your inquiry"
                        class="w-full outline-none px-4 py-2 border rounded-lg shadow-sm focus:border-yellow-300 @error('subject') border-red-600 @enderror"
                    >
                    @error ('subject')
                        <small class="text-xs text-red-600">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <div class="mt-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Message</label>
                    <textarea
                        type="text"
                        name="message"
                        placeholder="Lay down your thoughts here..."
                        rows="8"
                        class="w-full resize-none outline-none px-4 py-2 border rounded-lg shadow-sm focus:border-yellow-300 @error('message') border-red-600 @enderror"
                    ></textarea>
                    @error ('message')
                        <small class="text-xs text-red-600">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
                <div class="mt-4 text-right">
                    <button
                        class="g-recaptcha px-6 py-2 border outline-none border-green-400 text-green-400 rounded-lg shadow-sm hover:bg-green-400 hover:text-white hover:shadow-lg"
                        data-sitekey="{{ config('services.recaptcha.key') }}"
                        data-callback="onSubmit"
                    >Submit</button>
                </div>
            </form>

        </div>

    </div>

@endsection
