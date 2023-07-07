<?php

namespace App\Actions\Students;

// use ProtoneMedia\Splade\SpladeTable;
use App\Tables\Students;

class AllStudents
{
  public function __invoke()
  {
    return view('students.index', [
      'students' => Students::build(),
      /*'students' => SpladeTable::for(\App\Models\Student::class)
        ->column(key: 'first_name', alignment: 'left')
        ->column(key: 'last_name', alignment: 'left')
        ->column('birthday', 'Born on')
        ->column('guardian')
        ->paginate(15),*/
    ]);
  }
}
