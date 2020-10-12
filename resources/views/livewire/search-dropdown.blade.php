{{-- Search bar &4 Dropdown Element --}}
<div class="relative mt-3 md:mt-0" x-data="{ isOpen: true }" @click="isOpen = true">
    <input wire:model.debounce.500ms="search" type="text"
            class="bg-gray-800 rounded-full text-small w-64 px-4 pl-8 py-1 focus:outline-none focus:shadow-outline focus:bg-gray-700 focus:text-gray-100" placeholder="Search (Press '/' to focus)"
            x-ref="search"
            @keydown.window="
                if(event.keyCode === 191){
                    event.preventDefault();
                    $refs.search.focus();
                }
            "
            @focus="isOpen = true"
            @keydown="isOpen = true"
            >
    <div class="absolute top-0">
        <svg class="text-gray-500 w-4 h-4 mt-2 ml-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
    </div>

    <div wire:loading class="spinner top-0 right-0 mr-4 mt-4"></div>

    @if(strlen($search)>= 2)
        <div class="absolute bg-gray-800 text-sm rounded w-64 mt-4 z-10"
        x-show.transition.duration.500ms.opacity="isOpen"
        @click.away="isOpen=false"
        @keydown.escape.window="isOpen=false"
        >
            @if ($searchResults->count()>0)
                <ul>
                    {{-- Dropdown results --}}
                    @foreach ($searchResults as $result)
                        @if ($result['media_type'] === 'movie')
                            <li class="border-b border-gray-700">
                                <a href="{{ route('movies.show', $result['id']) }}" class="flex items-center hover:bg-gray-700 px-3 py-3">
                                    @if ($result['poster_path'])
                                        <img src="https://image.tmdb.org/t/p/w92/{{ $result['poster_path'] }}" alt="Poster" class="w-16 h-16">
                                    @else
                                        <img src="https://via.placeholder.com/50x75" alt="Poster" class="w-16 h-16">
                                    @endif
                                    <span class="ml-4">{{ $result['title'] }}</span>
                                </a>
                            </li>

                            @elseif ($result['media_type'] === 'tv')
                                <li class="border-b border-gray-700">
                                    <a href="{{ route('tv.show', $result['id']) }}" class="flex items-center hover:bg-gray-700 px-3 py-3">
                                        @if ($result['backdrop_path'])
                                            <img src="https://image.tmdb.org/t/p/w92/{{ $result['backdrop_path'] }}" alt="Poster" class="w-16 h-16">
                                        @else
                                            <img src="https://via.placeholder.com/50x75" alt="Poster" class="w-16 h-16">
                                        @endif
                                        <span class="ml-4">{{ $result['original_name'] }}</span>
                                    </a>
                                </li>

                            @elseif ($result['media_type'] = 'person')
                                <li class="border-b border-gray-700">
                                    <a href="{{ route('actors.show', $result['id']) }}" class="flex items-center hover:bg-gray-700 px-3 py-3">
                                        @if ($result['profile_path'])
                                            <img src="https://image.tmdb.org/t/p/w500{{ $result['profile_path'] }}" alt="Poster" class="w-16 h-16">
                                        @else
                                            <img src="https://via.placeholder.com/50x75" alt="Poster" class="w-16 h-16">
                                        @endif
                                        <span class="ml-4">{{ $result['name'] }}</span>
                                    </a>
                                </li>
                            @endif
                    @endforeach
                </ul>
            @else
                {{-- If there is no result --}}
                <div class="px-3 py-3">No results for "{{ $search }}"</div>
            @endif
        </div>
    @endif
</div>

