<?php

namespace App\Actions\SchoolYears;

use App\Models\SchoolYear;
use App\Models\User;
use App\Rules\SubsequentYears;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use ProtoneMedia\Splade\Facades\Toast;

class StoreSchoolYear
{
  public function __invoke(Request $request)
  {
    $validatedData = $this->validateData($request->all());

    $school_year = new SchoolYear();
    $school_year->year = $validatedData['year'];
    $school_year->save();

    Toast::autoDismiss(7)->title('Amazing!')->success('School year was successfully created!');

    return redirect()->back();
  }

  private function validateData(array $data)
  {
    $messages = [
      'year.required' => 'Please enter a valid school year.',
      'year.regex' => 'School year should be in the format `xxxx-xxxx` e.g 2021-2022.',
      'year.unique' => 'The year you provided is already in the system.',
    ];

    return validator($data, [
      'year' => [
        'required',
        'regex:/^\d{4}-\d{4}$/',
        new SubsequentYears,
        Rule::unique('school_years')->where(function ($query) {
          return $query->where('year', request('year'));
        }),
      ],
    ], $messages)->validate();
  }
}
