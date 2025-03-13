<?php

namespace Travelx\School\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Travelx\School\App\Models\Student;



class StudentTest extends TestCase
{
    use RefreshDatabase;

    public function test_index(): void
    {
        Student::factory()->count(3)->create();


        $response = $this->get('/students');

        $response->assertStatus(200);
        $response->assertJsonStructure(['students' => []]);
    }

    public function test_create(): void
    {
        $response = $this->get('/students/create');

        $response->assertStatus(200);
    }

    public function test_store(): void
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
        ];

        $response = $this->postJson('/students', $data);

        $response->assertStatus(201)
            ->assertJson([
                'message' => 'Student created successfully',
                'student' => [
                    'name' => 'John Doe',
                    'email' => 'johndoe@example.com',
                ]
            ]);

        $this->assertDatabaseHas('students', [
            'email' => 'johndoe@example.com',
        ]);
    }


    public function test_store_it_requires_a_valid_email()
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'invalid-email',
        ];

        $response = $this->postJson('/students', $data);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['email']);
    }

    public function test_store_it_requires_a_unique_email()
    {
        Student::factory()->create(['email' => 'existing@example.com']);

        $data = [
            'name' => 'Jane Doe',
            'email' => 'existing@example.com',
        ];

        $response = $this->postJson('/students', $data);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['email']);
    }

    public function test_show_success(): void
    {
        $student = Student::factory()->create([
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
        ]);

        $response = $this->getJson("/students/{$student->id}");

        $response->assertStatus(200)
            ->assertJson([
                'student' => [
                    'id' => $student->id,
                    'name' => 'John Doe',
                    'email' => 'johndoe@example.com',
                ],
            ]);
    }

    public function test_show_not_found(): void
    {
        $nonExistentId = 9999;

        $response = $this->getJson("/students/{$nonExistentId}");

        $response->assertStatus(404)
            ->assertJson([
                'message' => "No query results for model [Travelx\\School\\App\\Models\\Student] {$nonExistentId}",
            ]);
    }

    public function test_edit_success(): void
    {
        $student = Student::factory()->create([
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
        ]);

        $response = $this->getJson("/students/{$student->id}/edit");

        $response->assertStatus(200)
            ->assertJson([
                'student' => [
                    'id' => $student->id,
                    'name' => 'John Doe',
                    'email' => 'johndoe@example.com',
                ],
            ]);
    }

    public function test_edit_not_found(): void
    {
        $nonExistentId = 9999;

        $response = $this->getJson("/students/{$nonExistentId}/edit");

        $response->assertStatus(404)
            ->assertJson([
                'message' => "No query results for model [Travelx\\School\\App\\Models\\Student] {$nonExistentId}",
            ]);
    }

    public function test_update_success(): void
    {
        $student = Student::factory()->create([
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
        ]);

        $data = [
            'name' => 'Jane Doe',
            'email' => 'janedoe@example.com',
        ];

        $response = $this->putJson("/students/{$student->id}", $data);

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Student updated successfully',
                'student' => [
                    'id' => $student->id,
                    'name' => 'Jane Doe',
                    'email' => 'janedoe@example.com',
                ],
            ]);

        $this->assertDatabaseHas('students', [
            'id' => $student->id,
            'name' => 'Jane Doe',
            'email' => 'janedoe@example.com',
        ]);
    }

    public function test_update_email_unique_validation(): void
    {
        $student1 = Student::factory()->create([
            'email' => 'johndoe@example.com',
        ]);

        $student2 = Student::factory()->create([
            'email' => 'janedoe@example.com',
        ]);

        $data = [
            'email' => 'johndoe@example.com',
        ];

        $response = $this->putJson("/students/{$student2->id}", $data);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['email']);
    }

    public function test_update_not_found(): void
    {
        $nonExistentId = 9999;

        $data = [
            'name' => 'Jane Doe',
            'email' => 'janedoe@example.com',
        ];

        $response = $this->putJson("/students/{$nonExistentId}", $data);

        $response->assertStatus(404)
            ->assertJson([
                'message' => "No query results for model [Travelx\\School\\App\\Models\\Student] {$nonExistentId}",
            ]);
    }

    public function test_destroy_success(): void
    {
        $student = Student::factory()->create([
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
        ]);

        $response = $this->deleteJson("/students/{$student->id}");

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Student deleted successfully',
            ]);

        $this->assertDatabaseMissing('students', [
            'id' => $student->id,
        ]);
    }

    public function test_destroy_not_found(): void
    {
        $nonExistentId = 9999;

        $response = $this->deleteJson("/students/{$nonExistentId}");

        $response->assertStatus(404)
            ->assertJson([
                'message' => "No query results for model [Travelx\\School\\App\\Models\\Student] {$nonExistentId}",
            ]);
    }
}
