<?php

use Travelx\School\App\Models\Teacher;
use function Pest\Laravel\{get};
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(Tests\TestCase::class, RefreshDatabase::class)->in('Feature');

it('displays the teacher list', function () {
    Teacher::factory()->count(3)->create();

    $response = get(route('teachers.index'));

    $response->assertStatus(200);
    $response->assertViewIs('school::TeacherList');

    $teachers = Teacher::all();
    foreach ($teachers as $teacher) {
        $response->assertSee($teacher->name);
        $response->assertSee($teacher->phone_number);
    }
});

