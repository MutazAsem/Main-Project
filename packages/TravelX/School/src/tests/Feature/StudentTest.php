<?php

namespace Travelx\School\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Travelx\School\App\Models\Student;
 


class StudentTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_index(): void
    {
        // أضف بعض الطلاب للاختبار
        Student::factory()->count(3)->create();
        

        // dd($student);

        // إرسال طلب GET
        $response = $this->get('/students');

        // التحقق من أن الاستجابة كانت ناجحة
        $response->assertStatus(200);
        $response->assertJsonStructure(['students' => []]); // تأكد من أن الهيكل يحتوي على الطلاب
    }

    // public function test_create(): void
    // {
    //     $response = $this->get('/students');

    //     $response->assertStatus(200);
    // }

    // public function test_store(): void
    // {
    //     $response = $this->get('/students');

    //     $response->assertStatus(200);
    // }

    // public function test_show(): void
    // {
    //     $response = $this->get('/students');

    //     $response->assertStatus(200);
    // }

    // public function test_edit(): void
    // {
    //     $response = $this->get('/students');

    //     $response->assertStatus(200);
    // }
    
    // public function test_update(): void
    // {
    //     $response = $this->get('/students');

    //     $response->assertStatus(200);
    // }
    
    // public function test_destroy(): void
    // {
    //     $response = $this->get('/students');

    //     $response->assertStatus(200);
    // }
    
}
