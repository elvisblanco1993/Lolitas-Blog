<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex">
            {{-- Dashboard Stuff here --}}
            {{-- <div class="w-1/3 bg-gray-50 text-gray-600 rounded-lg shadow p-6">

                <p class="font-bold text-4xl text-indigo-600">{{ $total_views }}</p>

                <small class="block">
                    {{__('Total post views')}}
                </small>

            </div> --}}

            <div class="w-full">
                {!! $chart_post_by_visits->render() !!}
            </div>
        </div>
    </div>
</x-app-layout>
