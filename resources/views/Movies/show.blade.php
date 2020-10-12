@extends('Layout.main')

{{-- Show movies details  page --}}
@section('movies')
    <div class="movie-info border-b border-gray-800">
        <div class="container mx-auto items-center md:items-start px4 py-4 md:py-16 flex flex-col md:flex-row">
            <div class="img-container flex-none">
                @if ($movie['poster_path'])
                    <img src="{{ $movie['poster_path'] }}" alt="Poster of {{ $movie['title']}}" class="w-64 md:w-96">
                @else
                    <img class="w-64 md:w-96" src="https://dummyimage.com/400x600/1D2333/ffffff&text=Movie+Has+No+Poster">
                @endif
            </div>
            <div class="ml-5 mr-5 md:ml-24 mt-4 md:mt-0">
                <h2 class="text-4xl font-semibold">{{ $movie['title'] }}</h2>
                <div class="flex flex-wrap items-center text-gray-400 text-sm mt-1">
                    <svg class="fill-current text-orange-500 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                        </path>
                    </svg>
                    <span class="ml-1">{{ $movie['vote_average']}}</span>
                    <span class="mx-2">|</span>
                    <span>{{ $movie['release_date'] }}</span>
                    <span class="mx-2">|</span>
                    <span>
                       {{ $movie['genres'] }}
                    </span>
                </div>
                <p class="text-gray-300 mt-8">
                    {{$movie['overview']}}
                </p>
                {{-- Display the movie cast details --}}
                <div class="mt-8 md:mt-12">
                    <h3 class="text-white text-base md:text-lg font-semibold">Featured Crew</h3>
                    <div class="flex mt-4">
                        @foreach ($movie['crew'] as $crew )
                                <div class="mr-8">
                                    <h6>{{ $crew['name'] }}</h6>
                                    <p class="text-sm text-gray-400">{{ $crew['job'] }}</p>
                                </div>
                        @endforeach
                    </div>
                </div>
                <div x-data="{ isOpen: false }">
                    {{-- Extract from the API the movies videos in particular the movie's trailer  --}}
                    @if (count($movie['videos']['results']) > 0  && collect($movie['videos']['results'])->where('type', 'Trailer'))
                        <div class="mt-6 md:mt-12">
                            <button
                                @click="isOpen = true"
                                class="button flex mt-2 items-center bg-orange-500 text-gray-900 rounded-full shadow font-semibold px-5 py-4 hover:bg-orange-600 scale-100 transition-all ease-in-out duration-150 focus:outline-none">
                                    <span class="ml-1">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </span>
                                    Play Trailer
                            </button>
                            <div
                                style="background-color: rgba(0, 0, 0, 0.2);"
                                class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
                                x-show="isOpen">
                                <div class="container mx-auto lg:px32 rounded-lg overflow-y-auto shadow-2xl">
                                    <div class="bg-gray-900 rounded ">
                                        <div class="flex justify-end pr-4 pt-2">
                                            <button
                                                @click=" isOpen = false  "
                                                class="text-3xl leading-none hover:text-gray-300">&times;
                                            </button>
                                        </div>
                                        <div class="modal-body px-8 py-8">
                                            <div class="responsive-container overflow-hidden relative"
                                                style="padding-top:56.25%" >
                                                <iframe class="responsive-iframe absolute top-0 left-0 w-full h-full"
                                                    width="560"
                                                    height="315"
                                                    src="https://www.youtube.com/embed/{{ $movie['videos']['results'][0]['key'] }}"
                                                    frameborder="0"
                                                    allow="accelerometer; autoplay; encrypted-media; picture-in-picture"
                                                    allowfullscreen>
                                                </iframe>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div> <!-- end movie-info  -->
    {{-- Movie-cast --}}
    <div class="movie-cast border-b border-gray-800">
        <div class="container mx-auto px-4 py-4 md:py-16">
            <h2 class="text-4xl font-semibold text-orange-500">Cast</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ($movie['cast'] as $cast)
                    <div class="mt-8">
                        <a href="{{ route('actors.show', $cast['id']) }}">
                            <img src="{{ 'https://image.tmdb.org/t/p/w300/'.$cast['profile_path'] }}" alt="Actor/Actress Photo" class="hover:opacity-75 transition ease-in-out duration-120">
                        </a>
                        <div class="mt-4">
                            <div class="flex items-center text-gray-400 text-sm mt-1">
                                <div>
                                    <a href="{{ route('actors.show', $cast['id']) }}"><h6 class="text-lg">{{ $cast['name'] }}</h6></a>
                                    <p class="text-sm text-gray-400">{{ $cast['character'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
            @endforeach
            </div>
        </div>
    </div> {{-- end of cast section --}}
    {{-- images gallery --}}
    <div class="movie-gallery" x-data="{ isOpen:false, image:''}">
        <div class="container mx-auto px-4 py-4 md:py-16">
            <h2 class="text-4xl font-semibold text-orange-500">Image Gallery</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                @if (count($movie['images']) > 0  )
                    @foreach ($movie['images'] as $image)
                        <div class="mt-8">
                            <a
                                @click.prevent="
                                    isOpen = true
                                    image = '{{ 'https://image.tmdb.org/t/p/original/'.$image['file_path'] }}'
                                "
                                href="#">
                                <img src="{{ 'https://image.tmdb.org/t/p/w500/'.$image['file_path'] }}" alt="Movie Image" class="hover:opacity-75 transition ease-in-out duration-120">
                            </a>
                        </div>
                    @endforeach
                @else
                        <h2 class="text-lg text-gray-400 font-semibold">No Images Found</h2>
                @endif
            </div>
            <div
                style="background-color: rgba(0, 0, 0, 0.2);"
                class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
                x-show="isOpen">
                <div class="container mx-auto lg:px32 rounded-lg overflow-y-auto">
                    <div class="bg-gray-900 rounded shadow-2xl">
                        <div class="flex justify-end pr-4 pt-2">
                            <button @click="isOpen = false" class="text-3xl leading-none hover:text-gray-300">&times;</button>
                        </div>
                        <div class="modal-body px-8 py-8">
                            <img :src="image" alt="Poster">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
