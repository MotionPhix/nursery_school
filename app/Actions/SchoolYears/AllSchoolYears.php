<?php

namespace App\Actions\SchoolYears;

use App\Models\SchoolYear;

class AllSchoolYears
{
  public function __invoke()
  {
    $school_years = SchoolYear::get(['year', 'id']);

    return response()->json($school_years);
  }
}
