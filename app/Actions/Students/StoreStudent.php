<?php

namespace App\Actions\Students;

use App\Models\Grade;
use App\Models\SchoolYear;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Validation\Rule;
use ProtoneMedia\Splade\Facades\Toast;


class StoreStudent
{
  public function __invoke(Request $request, Grade $grade)
  {
    // dd($request->all());

    // Validate the input data
    $validatedData = $this->validateData($request->all());

    $student = new Student();

    $student->first_name = $validatedData['first_name'];
    $student->last_name = $validatedData['last_name'];
    $student->birthday = $validatedData['birthday'];
    $student->user_id = $validatedData['user_id'];
    $student->save();

    $student->grades()->attach($grade, [
      'enrollment_date' => now(),
      'school_year_id' => $request->school_year_id,
    ]);

    Toast::autoDismiss(7)->title('Excellent work!')->success('Student was successfully added.');

    return redirect()->back();
  }

  private function validateData(array $data)
  {
    return validator($data, [
      'first_name' => 'required|string|max:50',
      'last_name' => 'required|string|max:50',
      'user_id' => [
        'required',
        Rule::exists('users', 'id')->where('type', 'guardian')
      ],
      'birthday' => 'required|date|before_or_equal:' . Date::today()->subMonths(8)->format('Y-m-d')
    ])->validate($this->messages());
  }

  protected function messages()
  {
    return [
      'user_id.required' => 'Please pick a guardian for the student.',
      'user_id.exists' => 'The selected user is not valid or is not a guardian.',
      'birthday.required' => 'The birth of date field is required.',
      'birthday.before_or_equal' => 'The student must be at least 8 months old to join our school.',
    ];
  }
}
