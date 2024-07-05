<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex gap-10 py-12">
    <div class="w-64">
        <a href="{{ route('threads.create') }}" wire:navigate class="block w-full py-4 mb-10 bg-gradient-to-r from-blue-600 to-blue-700 hover:to-blue-600 text-white/90 font-bold text-xs text-center rounded-md">Preguntar</a>
        <ul>
            @foreach($categories as $category)
            <li>
                <a href="#" wire:click.prevent="filterByCategory('{{ $category->id }}')" class="p-2 rounded-md flex bg-slate-800 items-center gap-2 text-white/60 hover:text-white font-semibold text-xs capitalize">
                    <span class="w-2 h-2 rounded-full" style="background-color: {{ $category->color }};"></span>
                    {{ $category->name }}
                </a>
            </li>
            @endforeach
            <li>
                <a href="#" wire:click.prevent="filterByCategory('')" class="p-2 rounded-md flex bg-slate-800 items-center gap-2 text-white/60 hover:text-white font-semibold text-xs capitalize">
                    <span class="w-2 h-2 rounded-full" style="background-color: #000;"></span>
                    Todos los resultados
                </a>
            </li>
        </ul>
    </div>
    <div class="w-full">

        <form class="mb-4">
            <input type="text" placeholder="//..." 
            class="bg-slate-800 border-0 rounded-md w-1/3 p-3 text-white/60 text-xs"
            wire:model.live="search">
        </form>


        @foreach($threads as $thread)
        <div class="rounded-md bg-gradient-to-r from-slate-800 to-slate-900 hover:to-slate-800 mb-4">
            <div class="p-4 flex gap-4">
                <div>
                    <img src="{{ $thread->user->avatar() }}" alt="{{ $thread->user->name }}" class="rounded-md">
                </div>
                <div class="w-full">
                    <h2 class="mb-4 flex items-start justify-between">
                        <a href="{{ route('thread', $thread) }}" wire:navigate class="text-xl font-semibold text-white/90 ">
                            {{$thread->title}}
                        </a>
                        <span 
                        class="rounded-full text-xl py-2 px-4 capitalize" 
                        style="color: {{ $thread->category->color }}; border: 1px solid {{ $thread->category->color }};">
                            {{ $thread->category->name }}
                        </span>
                    </h2>
                    <p class="flex items-center justify-between w-full text-xs">
                        <span class="text-blue-600 font-semibold">
                            {{ $thread->user->name }}

                            <span class="text-white/90">{{ $thread->created_at->diffForHumans(); }}</span>
                        </span>
                        <span class="flex items-center gap-1 text-slate-700 ">
                            <svg class="h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                <path fill-rule="evenodd" d="M4.804 21.644A6.707 6.707 0 0 0 6 21.75a6.721 6.721 0 0 0 3.583-1.029c.774.182 1.584.279 2.417.279 5.322 0 9.75-3.97 9.75-9 0-5.03-4.428-9-9.75-9s-9.75 3.97-9.75 9c0 2.409 1.025 4.587 2.674 6.192.232.226.277.428.254.543a3.73 3.73 0 0 1-.814 1.686.75.75 0 0 0 .44 1.223ZM8.25 10.875a1.125 1.125 0 1 0 0 2.25 1.125 1.125 0 0 0 0-2.25ZM10.875 12a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Zm4.875-1.125a1.125 1.125 0 1 0 0 2.25 1.125 1.125 0 0 0 0-2.25Z" clip-rule="evenodd" />
                            </svg>

                            {{ $thread->replies_count }}
                            Respuesta{{ $thread->replies_count !== 1 ? 's': '' }}
                            @can('update',$thread)
                            |
                            <a href="{{ route('threads.edit', $thread) }}" class="hover:text-white">Editar</a>
                            @endcan
                        </span>
                    </p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
