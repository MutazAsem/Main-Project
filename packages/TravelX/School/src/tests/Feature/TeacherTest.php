<?php

namespace Travelx\School\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Travelx\School\App\Models\Teacher;



class TeacherTest extends TestCase
{
    use RefreshDatabase;

    public function test_index(): void
    {
        Teacher::factory()->count(3)->create();

        $response = $this->get(route('teachers.index'));

        $response->assertStatus(200);
        $response->assertViewIs('school::TeacherList');

        $teachers = Teacher::all();
        foreach ($teachers as $teacher) {
            $response->assertSee($teacher->name);
            $response->assertSee($teacher->phone_number);
        }
    }

    // public function test_create(): void
    // {
        
    // }

    // public function test_store(): void
    // {
        
    // }


    // public function test_store_it_requires_a_valid_email()
    // {
       
    // }

    // public function test_store_it_requires_a_unique_email()
    // {
       
    // }

    // public function test_show_success(): void
    // {
        
    // }

    // public function test_show_not_found(): void
    // {
       
    // }

    // public function test_edit_success(): void
    // {


    // }

    // public function test_edit_not_found(): void
    // {
       
    // }

    // public function test_update_success(): void
    // {
       
    // }

    // public function test_update_email_unique_validation(): void
    // {
        
    // }

    // public function test_update_not_found(): void
    // {
        
    // }

    // public function test_destroy_success(): void
    // {

    // }

    // public function test_destroy_not_found(): void
    // {

    // }
}
