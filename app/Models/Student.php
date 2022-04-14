<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'gender',
        'birthdate',
        'status',
        'avatar',
        'course_id',
    ];

    public function getAgeAttribute(): int
    {
        return date_diff(date_create($this->birthdate), date_create())->y;
    }

    public function getGenderNameAttribute(): string
    {
        return ($this->gender === 0) ? 'Male' : 'Female';
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
