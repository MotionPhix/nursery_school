<?php

namespace App\Actions\Students;

use App\Models\Grade;
use App\Models\SchoolYear;
use App\Models\Student;
use App\Tables\Students;

class ShowStudent
{
  public function __invoke(Student $student)
  {
    return view('students.show', [
      'student' => $student,
      'grades' => Grade::get()
    ]);
  }
}
