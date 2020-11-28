@extends('layouts.page')

@section('content')

    <div class="xs:container mx-auto max-w-4xl">

        {{-- Post Header --}}
        <div class="md:pt-16 text-center break-normal mx-2">
            <p class="text-4xl text-left font-bold">
                {{ $post->title }}
            </p>

            <div class="text-left ">
                @foreach ($post->tags as $tag)
                    <a class="bg-gray-200 text-gray-800 text-xs rounded mx-2 px-2 py-1 hover:cursor-pointer" href="{{ url('/tags/'.$tag->slug) }}">#{{$tag->slug}}</a>
                @endforeach
            </div>

            <div class="flex">
                <div class="flex md:w-2/3 mt-8 md:mt-12 text-left ">
                    <img
                        class="w-12 h-12 shadow rounded-full mr-4 avatar text-xs"
                        src="{{ url('/storage/'.$post->author->profile_photo_path) }}"
                        alt="{{ $post->author->name }}"
                    >

                    <div class="text-left inline-block align-middle font-sans">
                        <h2 class="text-md text-gray-700">{{ $post->author->name }}</h2>
                        <small class="text-gray-500">{{ date('M d, Y', strtotime( $post->publish_date )) }} ·
                            @if ((str_word_count($post->body))/200 < 1)
                                {{'1'}}
                            @else
                                {{ round((str_word_count($post->body))/200) }}
                            @endif
                            min read
                        </small>
                        {{ $views }}

                    </div>
                </div>

                <!-- Show some love -->
                @livewire('like-post', ['post_id' => $post->id, 'love' => $post->love])
            </div>


            @if (! is_null($post->featured_image))
                <img class="mt-4 w-full overflow-x-hidden" src="{{url('storage/images/'.$post->featured_image) }}">
            @endif
            <small class="text-gray-500">
                {{ $post->featured_image_caption }}
            </small>
        </div>

        {{-- Post Contents --}}
        <div class="pt-4 break-normal text-left appearance-none markdown text-cool-gray-700 mx-2">
            @parsedown($post->body)
        </div>

        {{-- Related Posts --}}
        <div class="py-8 md:py-16 text-center break-normal mx-2">
            <h3 class="font-bold text-xl text-left mb-4">
                Other readings
            </h3>
            <div class="flex">
                @forelse ($related as $related_post)
                    <a
                        href="{{ url('reading/'.$related_post->slug) }}"
                        class="w-1/3 mx-2 object-cover hover:shadow-xl bg-cover"
                        style="background-image: url({{ url('/storage/images/'.$related_post->featured_image) }})"
                    >

                        <div class="py-16 bg-gray-900 bg-opacity-75 hover:bg-opacity-50 hover:underline text-white">
                            {{ $related_post->title }}
                        </div>

                    </a>
                @empty

                <p>There are no related posts at this time...</p>

                @endforelse
            </div>
        </div>
        <hr>

        {{-- Comments --}}
        @if ($post->comments == 1)
            <div id="disqus_thread" class="mt-16"></div>
            <script>

                var disqus_config = function () {
                this.page.url = '{{ Request::url() }}';
                this.page.identifier = '{{ $post->slug }}';
                };

                (function() { // DON'T EDIT BELOW THIS LINE
                    var d = document, s = d.createElement('script');
                    s.src = 'https://lolitas-blog.disqus.com/embed.js';
                    s.setAttribute('data-timestamp', +new Date());
                    (d.head || d.body).appendChild(s);
                })();
            </script>
            <noscript>Please enable JavaScript to view the
                <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a>
            </noscript>

        @else
            <p class="mt-8 text-gray-600">Comments are disabled for this article.</p>
        @endif

    </div>


@endsection
