<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow overflow-hidden sm:rounded-lg p-6">
                {{-- Search --}}
                <div class="mb-4 flex justify-between items-center">
                    <div class="flex-1 pr-4">
                        <div class="relative md:w-1/3">
                            <form action="" method="get">
                                @csrf
                                <input type="search" class="w-full pl-10 pr-4 py-2 rounded-lg shadow focus:outline-none focus:shadow-outline text-gray-600 font-medium" placeholder="Search...">

                                <div class="absolute top-0 left-0 inline-flex items-center p-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
                                        <circle cx="10" cy="10" r="7"></circle>
                                        <line x1="21" y1="21" x2="15" y2="15"></line>
                                    </svg>
                                </div>
                            </form>
                        </div>

                    </div>
                    {{-- Add Article --}}
                    <div>
                        <a class="pl-1 pr-3 py-2 text-gray-500 rounded-lg font-semibold shadow hover:bg-gray-100 inline-flex items-center" href="{{ url('/tag/new') }}">
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            New
                        </a>
                    </div>
                </div>

                {{-- Table --}}
                <div class="overflow-x-auto bg-white rounded-lg overflow-y-auto relative border border-gray-100" style="height: 500px;">
                    <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                        <thead>
                            <tr class="text-left">
                                    <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-4 text-gray-600 font-bold tracking-wider uppercase text-xs">ID</th>

                                    <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-4 text-gray-600 font-bold tracking-wider uppercase text-xs">Slug</th>

                                    <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-4 text-gray-600 font-bold tracking-wider uppercase text-xs">Name</th>

                                    <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-4 text-gray-600 font-bold tracking-wider uppercase text-xs">Posts</th>

                                    <th class="bg-gray-100 sticky top-0 border-b border-gray-200 px-6 py-4 text-gray-600 font-bold tracking-wider uppercase text-xs">Actions</th>
                                </tr>
                        </thead>
                        <tbody>

                            @forelse ($tags as $tag)

                                <tr class="hover:bg-gray-50">
                                    <td class="border-dashed border-t border-gray-200">
                                        <span class="text-gray-700 px-6 py-3 flex items-center">
                                            {{ $tag->id }}
                                        </span>
                                    </td>
                                    <td class="border-dashed border-t border-gray-200">
                                        <span class="text-gray-700 px-6 py-3 flex items-center">
                                            {{ $tag->slug }}
                                        </span>
                                    </td>
                                    <td class="border-dashed border-t border-gray-200">
                                        <span class="text-gray-700 px-6 py-3 flex items-center">
                                            {{ $tag->name }}
                                        </span>
                                    </td>
                                    <td class="border-dashed border-t border-gray-200">
                                        <span class="text-gray-700 px-6 py-3 flex items-center">
                                            {{ count($tag->posts) }}
                                        </span>
                                    </td>
                                    <td class="border-dashed border-t border-gray-200">
                                        <div class="text-gray-700 px-6 py-3 flex items-center">

                                            <a href="{{ url('/tag/'. $tag->id.'/edit') }}" class="text-gray-500 mx-2" class="Edit tag">
                                                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>

                                            <button class="text-red-500 mx-2" title="Delete tag" id="delete-btn-{{$tag->id}}">
                                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>

                                        </div>
                                    </td>
                                </tr>

                            @empty

                            @endforelse

                        </tbody>
                    </table>
                </div>

                @forelse ($tags as $tag)
                    {{-- Delete Modal --}}
                    <div class="bg-black bg-opacity-50 absolute inset-0 hidden justify-center items-center" id="overlay-{{$tag->id}}">
                        <div class="bg-gray-200 max-w-md py-2 px-3 rounded shadow-xl text-gray-800">
                            <div class="flex justify-between items-center">
                                <h4 class="text-lg font-bold">Delete Tag?</h4>
                                <svg class="h-6 w-6 cursor-pointer p-1 hover:bg-gray-300 rounded-full" id="close-modal-{{$tag->id}}" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <div class="mt-2 text-gray-600">
                                <p>Are you sure you want to delete this post?</p>
                                <p>By deleting this tag, all related contents will be permanently lost.</p>
                            </div>
                            <div class="mt-3 flex justify-end space-x-4">
                                <button type="link"
                                    class="px-4 py-2 text-gray-500 rounded-lg font-semibold shadow hover:bg-gray-100"
                                    id="cancel-delete-{{$tag->id}}">
                                    Cancel
                                </button>

                                {{-- Delete Post Form --}}
                                <form class="inline-block align-text-middle" action="{{ url('/tag/'. $tag->id.'/delete') }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="px-4 py-2 text-gray-100 bg-red-600 rounded-lg font-semibold shadow hover:bg-red-800">
                                        Delete
                                    </button>

                                </form>
                            </div>
                        </div>
                    </div>

                    <script>
                        window.addEventListener('DOMContentLoaded', () =>{
                            const overlay = document.querySelector('#overlay-'+{{$tag->id}})
                            const delBtn = document.querySelector('#delete-btn-'+{{$tag->id}})
                            const closeBtn = document.querySelector('#close-modal-'+{{$tag->id}})
                            const cancelBtn = document.querySelector('#cancel-delete-'+{{$tag->id}})

                            const toggleModal = () => {
                                overlay.classList.toggle('hidden')
                                overlay.classList.toggle('flex')
                            }

                            delBtn.addEventListener('click', toggleModal)

                            closeBtn.addEventListener('click', toggleModal)

                            cancelBtn.addEventListener('click', toggleModal)
                        })

                    </script>
                @empty

                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>

