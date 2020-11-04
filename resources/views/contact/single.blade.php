<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6">

            <a  class="px-4 py-2 text-gray-500 rounded-lg font-semibold shadow hover:bg-gray-100 inline-flex items-center"
                href="{{ route('messages') }}">
                {{ __('Back to messages') }}
            </a>

            <div class="my-6">
                <div>
                    <span class="font-bold">
                        Sender:
                    </span>
                    <a class="ml-4 text-indigo-600" href="maito:{{ $sender_email }}">{{ $sender_name }}</a>
                </div>
                <div class="mt-4">
                    <span class="font-bold">
                        Subject:
                    </span>
                    <span class="ml-4">
                        {{ $subject }}
                    </span>
                </div>
                <div class="mt-4">
                    <span class="font-bold">
                        Message:
                    </span>
                    <div>
                        {{ $message }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
