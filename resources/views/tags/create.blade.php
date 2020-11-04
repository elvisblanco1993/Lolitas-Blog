<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6">

                <form action="{{ route('tag.save') }}" method="post">
                    @csrf

                    <input class="w-full px-4 py-2 font-bold text-xl rounded-lg shadow focus:outline-none focus:shadow-outline text-gray-600 @error('name') border border-red-600 @enderror" type="text" placeholder="Category name" name="name" value="{{old('name')}}">

                    @error('name')
                        <small class="text-red-600">{{ $message }}</small>
                    @enderror


                    <div class="flex justify-between">
                        <span>
                            @if (session('success'))
                                <div class="mt-4 mr-10 px-6 py-2 bg-green-200 rounded-lg">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if (session('error'))
                                <p class="mt-4 mr-10 px-6 py-2 bg-red-200 rounded-lg">
                                    Error. {{ session('error') }}
                                </p>
                            @endif
                        </span>
                        <span>
                            <a class="mt-4 px-6 py-2 bg-gray-100 text-gray-600 rounded-lg mr-4 hover:bg-gray-200" href="{{ route('tags') }}">Back</a>
                            <button class="mt-4 px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700" type="submit">Save category</button>
                        </span>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
