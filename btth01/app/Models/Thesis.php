<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thesis extends Model
{
    use HasFactory;
    
    protected $fillable = ['title', 'student_id', 'program', 'supervisor', 'abstract', 'submission_date', 'defense_date'];

    
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
