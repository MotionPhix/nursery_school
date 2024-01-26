<?php

namespace App\Actions\Grades;

use App\Models\Grade;
use App\Models\SchoolYear;
use App\Tables\Students;
use Illuminate\Http\Request;

class ShowGrade
{
  public function __invoke(Request $request, Grade $grade)
  {
    $school_year = $request->school_year;

    $school_year = $school_year ? $school_year : \App\Models\SchoolYear::latest()->value('id');

    return view('grades.show', [
      'grade' => $grade,
      'schoolYears' => SchoolYear::latest()->get(['year', 'id']),
      'students' => $grade->students()->count() ? Students::build($grade->id, $school_year) : ''
    ]);
  }
}
