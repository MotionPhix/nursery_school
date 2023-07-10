<?php

namespace App\Tables;

use App\Models\Student;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;

class Students extends AbstractTable
{
  private $id;
  private $year;
  /**
   * Create a new instance.
   *
   * @return void
   */
  public function __construct($id, $year)
  {
    $this->id = $id;
    $this->year = $year;
  }

  /**
   * Determine if the user is authorized to perform bulk actions and exports.
   *
   * @return bool
   */
  public function authorize(Request $request)
  {
    // return $request->user()->type !== 'guardian';
    return true;
  }

  /**
   * The resource or query builder.
   *
   * @return mixed
   */
  public function for()
  {
    return Student::query()->with('guardian')
      ->whereHas('grades', function ($query) {
        $query->where('grades.id', $this->id)
          ->where('grade_student_school_year.school_year_id', $this->year);
      });
  }

  /**
   * Configure the given SpladeTable.
   *
   * @param \ProtoneMedia\Splade\SpladeTable $table
   * @return void
   */
  public function configure(SpladeTable $table)
  {
    $availableYears = \App\Models\SchoolYear::pluck('year', 'id')->toArray();

    $table
      // ->withGlobalSearch(columns: ['id'])
      ->bulkAction(
        label: 'Delete',
        each: function (Student $student) {
          $student->grades()->delete();
          $student->delete();
        },
        confirm: true,
        requirePassword: true,
        after: fn () => Toast::autoDismiss()->title('Hooray!')->info('Student\'s data was expunged!')
      )

      ->column('first_name')
      ->column('last_name')
      ->column('born_on')
      ->column('age')
      ->column('guardian.first_name', 'Guardian')
      ->column('Actions')
      ->selectFilter(
        key: 'school_year_id',
        label: 'School Year',
        options: $availableYears
      )
      ->paginate(15);

    // ->searchInput()
    // ->selectFilter()
    // ->withGlobalSearch()

    // ->bulkAction()
    // ->export()
  }
}
