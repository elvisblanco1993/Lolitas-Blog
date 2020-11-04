@if (session('success'))
    <div class="alert px-4 py-2 w-full bg-green-300 text-green-800 rounded-lg border border-green-400 shadow my-1">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert px-4 py-2 w-full bg-red-300 text-red-800 rounded-lg border border-red-400 shadow my-1">
        {{ session('error') }}
    </div>
@endif


