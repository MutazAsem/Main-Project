<?php

 
 namespace Travelx\School\Database\Factories;




use Travelx\School\App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeacherFactory extends Factory
{
    protected $model = Teacher::class;

    public function definition()
    {
        return [
            // 'name' => $this->faker->name(),
            // 'phone_number' => $this->faker->unique()->phoneNumber(),
            'name' => $this->faker->name(),
            'phone_number' => $this->faker->phoneNumber(),

        ];
    }
}