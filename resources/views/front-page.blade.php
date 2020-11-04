@extends('layouts.page')

@section('content')
{{-- Heading --}}
<div
    class="flex py-32"
    style="background-image:url('https://source.unsplash.com/1_CMoFsPfso/2400x1602');
           background-size: cover;
           background-position: top left;"
>
    <div class="container max-w-4xl mx-auto text-center break-normal mt-auto">

        <!--Title-->
        <p class="text-white font-extrabold text-3xl md:text-5xl">
            {{ config('app.name', 'Lolitas Blog') }}
        </p>
        {{-- <p class="text-xl md:text-2xl text-gray-800"></p> --}}
    </div>
</div>

<div class="container max-w-4xl mx-auto -mt-32 overflow-x-hidden px-2">
    <!--Posts Container-->
    <div class="flex flex-wrap justify-between pt-12 -mx-6">

        @forelse ($posts as $post)
            <!--1/3 col -->

            @if ( $post->id )
            <div class="w-full md:w-1/2 p-6 flex flex-col flex-grow flex-shrink">
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
                                <a class="px-1 bg-yellow-100 text-gray-800 text-xs rounded hover:cursor-pointer"  href="{{ url('/tags/'.$tag->slug) }}">
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
            @endif
        @empty

        @endforelse


    </div>
    {{ $posts->links() }}
</div>
@endsection
