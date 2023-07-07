<?php

namespace App\Actions\Grades;

use App\Models\Grade;
use App\Tables\Students;

class ShowGrade
{
  public function __invoke(Grade $grade)
  {
    return view('grades.show', [
      'grade' => $grade,
      'students' => Students::build($grade->id)
    ]);
  }
}
