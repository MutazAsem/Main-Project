<?php

namespace Travelx\School\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Travelx\School\Database\Factories\StudentFactory;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email'];

    // علاقة الطالب مع المواد (Many-to-Many)
    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class, 'student_subject');
    }

    protected static function newFactory()
{
    return StudentFactory::new();
}
}
