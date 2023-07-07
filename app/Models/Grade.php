<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
  use HasFactory;

  public function students()
  {
    return $this->belongsToMany(Student::class, 'grade_student_school_year')
      ->withPivot('enrollment_date', 'school_year_id')
      ->withTimestamps();
  }
}
