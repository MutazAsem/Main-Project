<?php

namespace Tests\Feature;

use Tests\TestCase;

class SchoolTest extends TestCase
{

    public function test_school_controller(): void
    {
        $response = $this->get('/schoolController');

        $response->assertStatus(200);
    }
}
