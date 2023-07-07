<?php

namespace App\Actions\Grades;

use App\Models\Grade;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Toast;

class StoreGrade
{
  public function __invoke(Request $request)
  {
    // Validate the input data
    $validatedData = $this->validateData($request->all());

    $grade = new Grade();

    $grade->name = $validatedData['name'];

    $grade->save();

    Toast::autoDismiss(7)->title('Great going!')->success('Grade was successfully created.');

    return redirect()->back();
  }

  private function validateData(array $data)
  {
    return validator($data, [
      'name' => 'required|string|max:50',
    ])->validate();
  }
}
