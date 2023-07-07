<?php

namespace App\Actions\SchoolYears;

use App\Models\SchoolYear;

class AllSchoolYears
{
  public function __invoke()
  {
    return view('school-years.index', [
      'school_years' => SchoolYear::get(['year', 'id']),
    ]);
  }
}
