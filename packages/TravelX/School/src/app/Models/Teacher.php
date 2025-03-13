<?php

namespace Travelx\School\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'phone_number'];

    // علاقة المدرس مع المادة (One-to-One)
    public function subject(): HasOne
    {
        return $this->hasOne(Subject::class);
    }
}
