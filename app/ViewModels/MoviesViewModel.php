<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use Carbon\Carbon;

class MoviesViewModel extends ViewModel
{
    public $popularMovies;
    public $trendMovies;
    public $genres;
    public $nowPlayingMovies;

    public function __construct($popularMovies, $trendMovies,  $genres, $nowPlayingMovies)
    {
        $this->popularMovies = $popularMovies;
        $this->trendMovies = $trendMovies;
        $this->genres = $genres;
        $this->nowPlayingMovies = $nowPlayingMovies;
    }

    private function formatMovies($moviesType)
    {
        return collect($moviesType)->map(function ($movie) {
            $genresFormatted = collect($movie['genre_ids'])->mapWithKeys(function ($value) {
                return [$value => $this->genres()->get($value)];
            })->implode(', ');

            return collect($movie)->merge([
                'poster_path' => $movie['poster_path']
                    ? 'https://image.tmdb.org/t/p/w185' . $movie['poster_path']
                    : 'https://dummyimage.com/400x600/1D2333/ffffff&text=Movie+Has+No+Poster',
                'vote_average' => $movie['vote_average'] * 10 . '%',
                'release_date' => Carbon::parse($movie['release_date'])->format('M d, Y'),
                'genres' => $genresFormatted,
            ])->only([
                'poster_path', 'id', 'genre_ids', 'title', 'vote_average', 'overview', 'release_date', 'genres',
            ]);
        });
    }


    public function popularMovies()
    {
        return $this->formatMovies($this->popularMovies);
    }
    public function trendMovies()
    {
        return $this->formatMovies($this->trendMovies);
    }
    public function genres()
    {
        return collect($this->genres)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });
    }
    public function nowPlayingMovies()
    {
        return $this->formatMovies($this->nowPlayingMovies);
    }
}
