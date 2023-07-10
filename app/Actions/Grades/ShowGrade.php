<?php

namespace App\Actions\Grades;

use App\Models\Grade;
use App\Models\SchoolYear;
use App\Tables\Students;

class ShowGrade
{
  public function __invoke(Grade $grade, SchoolYear $school_year = null)
  {
    $school_year = $school_year ? $school_year : \App\Models\SchoolYear::latest()->value('id');

    return view('grades.show', [
      'grade' => $grade,
      'students' => $grade->students()->count() ? Students::build($grade->id, $school_year) : ''
    ]);
  }
}
