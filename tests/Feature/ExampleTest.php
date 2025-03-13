<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
// <?php

// namespace TravelX\School\Tests\Feature;

// use Tests\TestCase;

// class RouteTest extends TestCase
// {
//     public function test_school_route()
//     {
//         $response = $this->get('/school');
//         $response->assertStatus(200);
//     }
// }
