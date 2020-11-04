@extends('layouts.page')

@section('content')
    <div class="container px-4 md:px-0 max-w-6xl mx-auto">
        <div class="mt-8 text-2xl text-gray-700">
            {{__('Filter by tag: ')}}
            <span class="italic text-cool-gray-500">{{ request('tag') }}</span>
        </div>
        <div class="flex flex-wrap justify-between pt-12 -mx-6">

            @foreach ($posts as $post)

                <div class="w-full md:w-1/2 lg:w-1/3 p-6 flex flex-col flex-grow flex-shrink">
                    <div class="flex-1 bg-white rounded-t rounded-b-none overflow-hidden shadow-lg">
                        <a href="{{ url('reading/'.$post->slug) }}" class="flex flex-wrap no-underline hover:no-underline">
                            <img src="{{ url('/storage/images/'.$post->featured_image) }}" class="h-64 w-full object-cover rounded-t pb-6">
                            <p class="w-full text-gray-600 text-xs md:text-sm px-6">
                                {{ date('M d, Y', strtotime( $post->publish_date )) }}
                            </p>
                            <div class="w-full font-bold text-xl text-gray-900 px-6">
                                {{ $post->title }}
                            </div>
                            <p class="text-gray-800 font-serif text-base px-6 mb-5">
                                {{ Str::limit(strip_tags(parsedown($post->body)), 250, '...') }}
                            </p>
                            <p class="font-serif text-xs px-6 mb-5">
                                @foreach ($post->tags as $tag)
                                    <a class="text-indigo-500 mx-1" href="{{ url('/tags/'.$tag->slug) }}">
                                        #{{ $tag->slug }}
                                    </a>
                                @endforeach
                            </p>
                        </a>
                    </div>
                    <div class="flex-none mt-auto bg-white rounded-b rounded-t-none overflow-hidden shadow-lg p-6">
                        <div class="flex items-center justify-between">
                            <img class="w-8 h-8 rounded-full mr-4 avatar" data-tippy-content="{{ $post->author->name }}" src="{{ url('/storage/'.$post->author->profile_photo_path) }}" alt="Avatar of {{ $post->author->name }}" tabindex="0">
                            <p class="text-gray-600 text-xs md:text-sm">
                                @if ((str_word_count($post->body))/200 < 1)
                                        {{'1 MIN READ' }}
                                @else
                                        {{ round((str_word_count($post->body))/200) . ' MIN READ' }}
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

            @endforeach

        </div>
    </div>
@endsection
