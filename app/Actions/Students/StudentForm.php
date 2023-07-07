<?php

namespace App\Actions\Students;

use App\Models\Grade;
use App\Models\SchoolYear;
use App\Models\Student;
use App\Models\User;

class StudentForm
{
  public function __invoke(Grade $grade)
  {
    return view('students.create', [
      'student' => new Student(),

      'years' => SchoolYear::pluck('year', 'id')->toArray(),

      // 'guardians' => User::where('type', 'guardian')->pluck('first_name', 'last_name', 'id')->toArray(),

      'guardians' => User::where('type', 'guardian')->pluck('first_name', 'id')->transform(function ($firstName, $id) {
        return $firstName . ' ' . User::find($id)->last_name;
      })->toArray(),

      'grade' => $grade,
    ]);
  }
}
