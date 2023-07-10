<?php

namespace App\Actions\Grades;

use App\Models\Grade;

class AllGrades
{
  public function __invoke()
  {
    return view('grades.index', [
      'grades' => Grade::get(['name', 'description', 'id']),
    ]);
  }
}
