<?php

namespace Travelx\School\App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentSubject extends Model
{
    use HasFactory;

    protected $table = 'student_subject';

    protected $fillable = ['student_id', 'subject_id'];
}
