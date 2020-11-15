<nav class="mx-auto overflow-x-hidden">
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
            <div class="py-6 flex items-center uppercase">
                <a href="{{ route('frontpage') }}" class="mx-4 hover:text-yellow-400">
                    {{ __('Home') }}
                </a>
                <a href="{{ url('/contact') }}" class="mx-4 hover:text-yellow-400" title="{{ __('Have an article request? Send me your thoughts') }}">
                    {{ __('Contact') }}
                </a>
                <a href="{{ url('/login') }}" class="mx-4 hover:text-yellow-400" title="{{ __('Administrator login') }}">
                    {{ __('Login') }}
                </a>
            </div>
        </div>
    </div>
</nav>
