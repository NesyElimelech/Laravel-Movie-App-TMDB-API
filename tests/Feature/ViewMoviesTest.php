<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as TestingTestCase;
use Illuminate\Testing\TestResponse;
use PHPUnit\Framework\Test;
use Tests\TestCase;

class ViewMoviesTest extends TestCase
{
    public function the_main_page_shows_correct_info()
    {
        $response = $this->get(route('movies.index'));
        $response->assertSuccessful();
        $response->assertSee('popular movies');
    }
}
