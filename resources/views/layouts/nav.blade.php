<nav class="mx-auto bg-white border-b border-gray-100 overflow-x-hidden">
    {{-- Primary Navigation Menu --}}
    <div class="container max-w-4xl mx-auto">
        <div class="flex justify-between mx-2">
            <div class="py-6">
                <a
                    href="{{ route('frontpage') }}"
                    class="font-Merriweather font-black text-xl text-black"
                >
                    {{ config('app.name') }}
                </a>
            </div>

            {{-- Navigation Links --}}
            <div class="py-6">
                <a href="{{ route('frontpage') }}" class="mx-4">
                    {{ __('Home') }}
                </a>
                <a href="{{ url('/contact') }}" class="ml-4" title="{{ __('Have an article request? Send me your thoughts') }}">
                    {{ __('Contact me') }}
                </a>
            </div>
        </div>
    </div>
</nav>
