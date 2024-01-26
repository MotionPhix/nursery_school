<?php

namespace App\Tables;

use App\Models\Student;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\AbstractTable;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\SpladeTable;

class Students extends AbstractTable
{
  private $gradeId;
  private $yearId;
  /**
   * Create a new instance.
   *
   * @return void
   */
  public function __construct($gradeId, $yearId)
  {
    $this->gradeId = $gradeId;
    $this->yearId = $yearId;
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
        $query->where('grades.id', $this->gradeId)
          ->where('grade_student_school_year.school_year_id', $this->yearId);
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
      ->column('actions', '')
      ->paginate(15);

    // ->searchInput()
    // ->selectFilter()
    // ->withGlobalSearch()

    // ->bulkAction()
    // ->export()
  }
}
