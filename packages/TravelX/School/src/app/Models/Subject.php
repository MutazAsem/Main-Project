<?php

namespace Travelx\School\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'teacher_id'];

    // علاقة المادة مع المدرس (One-to-One)
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    // علاقة المادة مع الطلاب (Many-to-Many)
    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'student_subject');
    }
}
