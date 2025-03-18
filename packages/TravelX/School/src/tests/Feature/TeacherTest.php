<?php
namespace Travelx\School\Tests\Feature;

use Travelx\School\App\Models\Teacher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\View;
use Tests\TestCase;

use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;
uses(TestCase::class, RefreshDatabase::class);


it('should return a list of teachers', function () {

    Teacher::factory()->count(5)->create();

    $response = $this->get(route('teachers.index'));

    $response->assertStatus(200);
    $response->assertViewHas('teachers');
    $teachers = $response->viewData('teachers');
    expect($teachers)->toHaveCount(5);
});

test('You can contact the Effective Teacher Creation page.', function () {
    $response = $this->get(route('teachers.create'));

    $response->assertStatus(200);
    $response->assertViewIs('school::TeacherCreate');
});


test('Save New Teacher', function () {

    $teacher = [
        'name' => 'John Doe',
        'phone_number' => '777555333',
    ];

    $response = $this->post(route('teachers.store', $teacher ));

    $response->assertStatus(302);
    $response->assertSessionHas('success', 'Teacher created successfully!'); 
    $response->assertRedirect(route('teachers.index'));

    $latestTeacher = Teacher::latest()->first();

    expect($latestTeacher)
    ->name->toBe($latestTeacher['name'])
    ->phone_number->toBe($latestTeacher['phone_number']);

    assertDatabaseHas('teachers', $teacher);
});


test('Data must be validated when creating a feature.', function () {

    $teacher = [
        'name' => '',
        'phone_number' => '',
    ];

    $response = $this->post(route('teachers.store'), $teacher);

    $response->assertSessionHasErrors(['name', 'phone_number']); 
    assertDatabaseCount('teachers', 0);
});

test('The phone number must be unique.', function () {
    $teacher = Teacher::factory()->create(['phone_number' => '123456789']);

    $response = $this->post(route('teachers.store'), [
        'name' => 'Jane Doe',
        'phone_number' => '123456789',
    ]);

    $response->assertSessionHasErrors(['phone_number']); 
    assertDatabaseCount('teachers', 1); 
});


test('Show Teacher.', function () {
    $teacher = Teacher::factory()->create([
        'name' => 'Jane Doe',
        'phone_number' => '123456789',
    ]);

    $response = $this->get(route('teachers.show' ,['teacher' => $teacher->id]));

    
    assertDatabaseCount('teachers', 1); 
    expect(Teacher::count())->toBe(1);
    $response->assertViewHas('teacher', $teacher);

});

it('Show Teacher returns 404 if the teacher does not exist', function () {

    $response = $this->get(route('teachers.show', 99999));

    $response->assertStatus(404);

});

it('displays the teacher edit page successfully', function () {

    $teacher = Teacher::factory()->create();

    $response = $this->get(route('teachers.edit', ['teacher' => $teacher->id]));

    $response->assertStatus(200);

    $response->assertViewIs('school::TeacherEdit');

    $response->assertViewHas('teacher', $teacher);
});

it('Edit Teacher returns 404 if the teacher does not exist', function () {

    $response = $this->get(route('teachers.edit', 99999));

    $response->assertStatus(404);
});

it('updates the teacher successfully', function () {

    $teacher = Teacher::factory()->create();


    $response = $this->put(route('teachers.update', $teacher->id), [
        'name' => 'Updated Name',
        'phone_number' => '1234567890',
    ]);

    $response->assertRedirect(route('teachers.index'));

    $teacher->refresh();
    expect($teacher->name)->toBe('Updated Name');
    expect($teacher->phone_number)->toBe('1234567890');

    $response->assertSessionHas('success', 'Teacher updated successfully!');
});


it('prevents updating to an already existing phone number', function () {

    $teacher1 = Teacher::factory()->create();
    $teacher2 = Teacher::factory()->create();

    $response = $this->put(route('teachers.update', $teacher1->id), [
        'phone_number' => $teacher2->phone_number,
    ]);

    $response->assertSessionHasErrors('phone_number');
});

it('returns 404 when updating a non-existent teacher', function () {

    $response = $this->put(route('teachers.update', 99999), [
        'name' => 'New Name',
        'phone_number' => '1234567890',
    ]);

    $response->assertStatus(404);
});


it('deletes a teacher successfully', function () {

    $teacher = Teacher::factory()->create();


    $response = $this->delete(route('teachers.destroy', $teacher->id));


    $response->assertRedirect(route('teachers.index'));


    $this->assertDatabaseMissing('teachers', ['id' => $teacher->id]);


    $response->assertSessionHas('success', 'Teacher deleted successfully!');
});


it('deletes Teacher returns 404 when deleting a non-existent teacher', function () {

    $response = $this->delete(route('teachers.destroy', 99999));

    $response->assertStatus(404);
});