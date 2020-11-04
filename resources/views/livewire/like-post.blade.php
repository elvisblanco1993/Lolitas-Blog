<div class="mt-10 md:mt-14 md:w-1/3 text-right px-2">
    {{-- Do your work, then step back. --}}
    <button wire:click="giveLove({{ $post_id }})" class="w-6 h-6 text-xs text-gray-400 hover:text-red-500" title="Love the post">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
        </svg>
        {{ $love }}
    </button>
</div>