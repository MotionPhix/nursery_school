<?php

namespace App\Actions\SchoolYears;

use App\Models\SchoolYear;

class SchoolYearForm
{
  public function __invoke()
  {
    return view('school-years.create', [
      'school_year' => new SchoolYear()
    ]);
  }
}
