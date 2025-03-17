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

        $response = $this->get(route('students.index'));

        $response->assertStatus(200);
        $response->assertViewIs('school::StudentList');

        $students = Student::all();
        foreach ($students as $student) {
            $response->assertSee($student->name);
            $response->assertSee($student->email);
        }
    }

    public function test_create(): void
    {
        $response = $this->get(route('students.create'));

        $response->assertStatus(200);
        $response->assertViewIs('school::StudentCreate');
    }

    public function test_store(): void
    {
        $response = $this->post(route('students.store'), [
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('students.index'));

        $this->assertDatabaseHas('students', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);
    }


    public function test_store_it_requires_a_valid_email()
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'invalid-email',
        ];

        $response = $this->post(route('students.store'), $data);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['email']);
    }

    public function test_store_it_requires_a_unique_email()
    {
        Student::factory()->create(['email' => 'existing@example.com']);

        $data = [
            'name' => 'Jane Doe',
            'email' => 'existing@example.com',
        ];

        $response = $this->post(route('students.store'), $data);


        $response->assertStatus(302);
        $response->assertSessionHasErrors(['email']);
    }

    public function test_show_success(): void
    {
        $student = Student::factory()->create([
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
        ]);

        $response = $this->get(route('students.show', ['student' => $student->id]));

        $response->assertStatus(200);

        $response->assertViewHas('student', function ($viewStudent) use ($student) {
            return $viewStudent->id === $student->id &&
                $viewStudent->name === $student->name &&
                $viewStudent->email === $student->email;
        });
    }

    public function test_show_not_found(): void
    {
        $nonExistentId = 9999;

        $response = $this->get(route('students.show', ['student' => $nonExistentId]));

        $response->assertStatus(404);
    }

    public function test_edit_success(): void
    {
        $student = Student::factory()->create([
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
        ]);

        $response = $this->get(route('students.edit', ['student' => $student->id]));

        $response->assertStatus(200);

        $response->assertViewHas('student', function ($viewStudent) use ($student) {
            return $viewStudent->id === $student->id &&
                $viewStudent->name === $student->name &&
                $viewStudent->email === $student->email;
        });
    }

    public function test_edit_not_found(): void
    {
        $nonExistentId = 9999;

        $response = $this->get(route('students.edit', ['student' => $nonExistentId]));

        $response->assertStatus(404);
    }

    public function test_update_success(): void
    {
        $student = Student::factory()->create([
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
        ]);

        $response = $this->put(route('students.update', ['student' => $student->id]), [
            'name' => 'Jane Doe',
            'email' => 'janedoe@example.com',
        ]);

        $response->assertStatus(302);

        $response->assertRedirect(route('students.index'));

        $student->refresh();
        $this->assertEquals('Jane Doe', $student->name);
        $this->assertEquals('janedoe@example.com', $student->email);
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

        $response = $this->put(route('students.update', ['student' => $student2->id]), $data);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['email']);
    }

    public function test_update_not_found(): void
    {
        $nonExistentId = 9999;

        $data = [
            'name' => 'Jane Doe',
            'email' => 'janedoe@example.com',
        ];

        $response = $this->put(route('students.update', ['student' => $nonExistentId]), $data);

        $response->assertStatus(404);
    }

    public function test_destroy_success(): void
    {
        $student = Student::factory()->create([
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
        ]);

        $response = $this->delete(route('students.destroy', ['student' => $student->id]));

        $response->assertStatus(302)
            ->assertRedirect(route('students.index'));
    
        $response->assertSessionHas('success', 'Student deleted successfully!');
    
        $this->assertDatabaseMissing('students', [
            'id' => $student->id,
        ]);
    }

    public function test_destroy_not_found(): void
    {
        $nonExistentId = 9999;

        $response = $this->delete(route('students.destroy', ['student' => $nonExistentId]));

        $response->assertStatus(404);
    }
}
