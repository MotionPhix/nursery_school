<?php

namespace App\Actions\Guardians;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use ProtoneMedia\Splade\Facades\Toast;

class StoreGuardian
{
  public function __invoke(Request $request)
  {
    $validatedData = $this->validateData($request->all());

    $guardian = new User();
    $guardian->first_name = $validatedData['first_name'];
    $guardian->last_name = $validatedData['last_name'];
    $guardian->email = $validatedData['email'];
    $guardian->type = 'guardian';
    $guardian->password = Hash::make($validatedData['password']);

    $guardian->save();

    Toast::autoDismiss(7)->title('Viola!')->success('Guardian successfully added!');

    return redirect()->back();
  }

  private function validateData(array $data)
  {
    $messages = [
      'first_name.required' => 'Please enter guardian\'s first name.',
      'first_name.max' => 'First name is too long. Max is 50 characters.',
      'last_name.required' => 'Please enter guardian\'s last name.',
      'last_name.max' => 'Last name is too long. Max is 50 characters.',

      'email.required' => 'Guardian\'s email address is required',
      'email.email' => 'You entered an invalid email address',
      'email.unique' => 'Email address is taken. Is the guardian already registered?',

      'password.required' => 'Provide a password for the guardian',
    ];

    return validator($data, [
      'first_name' => 'required|string|max:50',
      'last_name' => 'required|string|max:50',
      'email' => 'required|email|unique:users,email',
      'password' => 'required|string|min:6|confirmed',
    ], $messages)->validate();
  }
}
