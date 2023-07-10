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

  public function scopeBySchoolYear($query, $schoolYearId, $gradeId)
  {
    return $query->whereHas('students', function ($q) use ($schoolYearId) {
      $q->wherePivot('school_year_id', $schoolYearId);
    })
      ->where('grade_id', $gradeId);
  }
}
