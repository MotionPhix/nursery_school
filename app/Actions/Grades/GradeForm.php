<?php

namespace App\Actions\Grades;

use App\Models\Grade;

class GradeForm
{
  public function __invoke()
  {
    return view('grades.create', [
      'grade' => new Grade()
    ]);
  }
}
