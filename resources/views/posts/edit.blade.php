<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6">

                <form action="{{ url('/post/'.$post->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="w-2/3">
                        <input class="w-full px-4 py-2 font-bold text-2xl rounded-lg shadow focus:outline-none focus:shadow-outline text-gray-600 @error('title') border border-red-600 @enderror" type="text" placeholder="Post Title" name="title" value="{{ $post->title }}">
                        @error('title')
                            <small class="text-red-600">{{ $message }}</small>
                        @enderror
                    </div>

                    <link rel="stylesheet" href="{{ asset('css/easymde.min.css') }}">

                    <div class="w-full my-4">
                        <textarea
                            class="outline-none mt-4 p-4 w-full rounded-lg text-gray-700 focus:bg-gray-100 placeholder-gray-700 @error('body') border border-red-600 @enderror" name="body" rows="20" placeholder="Write something amazing..."
                        >{{ $post->body }}</textarea>
                        @error('body')
                            <small class="text-red-600">{{ $message }}</small>
                        @enderror

                    </div>

                    <script src="{{ asset('js/easymde.min.js') }}"></script>
                    <script>
                        var easyMDE = new EasyMDE({
                            autosave: {
                                enabled: true,
                                uniqueId: "edit-"+{{ $post->id }},
                                delay: 1000,
                                submit_delay: 5000,
                                timeFormat: {
                                    locale: 'en-US',
                                    format: {
                                        year: 'numeric',
                                        month: 'long',
                                        day: '2-digit',
                                        hour: '2-digit',
                                        minute: '2-digit',
                                    },
                                },
                                text: "Autosaved: "
                            },
                        });
                    </script>

                    {{-- Tags --}}
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="tags">Tags</label>
                    <select class="w-full pl-10 pr-4 py-2 rounded-lg shadow focus:outline-none focus:shadow-outline text-gray-600 font-medium" name="tag[]" multiple>
                        @foreach (App\Models\Tag::get() as $tag)
                            <option value="{{$tag->slug}}" @if ( count( $post->tags->where('id', $tag->id) ) == 1 ) selected="selected" @endif>
                                {{$tag->name}}
                            </option>
                        @endforeach
                    </select>

                    {{-- Featured image --}}
                    <label class="mt-6 block text-gray-700 text-sm font-bold mb-2" for="featured_image">Featured image</label>
                    <div class="relative mb-4">
                        <input
                            type="file"
                            name="featured_image"
                            class="w-1/3 px-4 py-2 shadow rounded-lg hover:bg-gray-100 hover:cursor-pointer"
                            accept="image/jpeg, image/png"
                        />
                        @error('featured_image')
                            <small class="text-red-600">{{ $message }}</small>
                        @enderror
                    </div>

                    <input
                        class="w-1/3 px-4 py-2 rounded-lg shadow focus:outline-none focus:shadow-outline placeholder-gray-600 text-gray-600 @error('title') border border-red-600 @enderror"
                        type="text"
                        name="featured_image_caption"
                        placeholder="Image caption text..."
                        value="{{ $post->featured_image_caption }}"
                    >

                    <div class="space-y-2 my-12">
                        <label class="flex items-center space-x-4">
                          <input
                            type="checkbox"
                            @if ($post->comments == 1) checked @endif
                            name="comments"
                            value="1"
                            class="h-3 w-3 border border-gray-400 rounded-full checked:bg-gray-900 checked:border-transparent focus:outline-none">
                          <span>Enable comments</span>
                        </label>
                    </div>

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
                            <a class="px-6 py-2 mx-1 text-gray-500 rounded-lg font-semibold shadow inline-flex hover:bg-gray-100 items-center" href="{{ url('/posts') }}">Back</a>
                            <button class="px-6 mx-1 py-2 text-gray-100 rounded-lg font-semibold shadow bg-indigo-600 hover:bg-indigo-700 inline-flex items-center" type="submit">Save</button>
                        </span>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
