@extends('Layout.main')

@section('content')
    <div class="container mx-auto px-4 pt-16">
        {{-- Popular movies section --}}
        <div class="trending-movies">
            <h2 class="uppercase text-lg md:text-4xl tracking-wider text-orange-500  font-semibold">Trending Movies</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ($trendMovies as $movie)
                    @if ($loop->index < 15 )
                        <x-movie-card :movie="$movie" />
                    @else
                        @break
                    @endif
                @endforeach
            </div>
        </div>
        {{-- Popular movies section --}}
        <div class="popular-movies mt-20">
            <h2 class="uppercase text-lg md:text-4xl tracking-wider text-orange-500  font-semibold">Popular Movies</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ($popularMovies as $movie)
                    @if ($loop->index < 15 )
                        <x-movie-card :movie="$movie" />
                    @else
                        @break
                    @endif
                @endforeach
            </div>
        </div>
        {{-- Now Playing section --}}
        <div class="now-playing mt-20">
            <h2 class="uppercase text-lg md:text-4xl tracking-wider text-orange-500 mt-16 font-semibold">Now Playing</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach ($nowPlayingMovies as $movie)
                    @if ($loop->index < 15 )
                        <x-movie-card :movie="$movie" />
                    @else
                        @break
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endsection
