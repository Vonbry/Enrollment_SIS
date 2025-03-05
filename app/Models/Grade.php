<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'subject_id',
        'midterm',
        'final',
        'average',
        'semester',
        'description',
        'numeric_grade',
        'us_grade'
    ];
    
    protected $attributes = [
        'average' => null,
        'numeric_grade' => null,
        'us_grade' => null,
        'description' => 'Regular Grade'
    ];
    
    
    

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }


}
