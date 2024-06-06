<x-app-layout>
    <x-container>
        <form action="{{ route('posts.store') }}" class="px-4 mb-8" method="POST">
            @csrf

            <textarea 
                name="body" 
                rows="2" 
                class="w-full 
                        mb-2 
                        p-0
                        text-black 
                        bg-transparent 
                        border-0 
                        border-b-2 
                        border-slate-800 
                        focus:border-b-slate-700 
                        focus:ring-0
                        resize-none
                        overflow-hidden"
                placeholder="Your comment..."
            ></textarea>

            <input 
                type="submit"
                class="px-4 py-2 bg-yellow-400 text-gray-400 font-semibold sm:rounded-lg text-xs">
        </form>

        @foreach ($posts as $post)
            <a href="{{ route('profile.show', $post->user) }}" class="px-6 mb-2 flex items-center gap-2 font-medium text-slate-800">
                <svg class="h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                    <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
                  </svg>
                  
                {{ $post->user->name }}
            </a>
            <x-card class="mb-4">
                {{ $post->body }}
                <div class="text-xs text-slate-500">
                    {{ $post->created_at->diffForHumans()}}
                </div>
            </x-card>            
        @endforeach
    </x-container>
</x-app-layout>
