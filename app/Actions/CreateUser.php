<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use ProtoneMedia\Splade\Facades\Toast;

class CreateUser
{
  public function __invoke(Request $request)
  {
    // Validate the input data
    $validatedData = $this->validateData($request->all());

    // Create a new user
    $user = User::create([
      'name' => $validatedData['name'],
      'email' => $validatedData['email'],
      'password' => Hash::make($validatedData['password']),
    ]);

    // You can perform additional actions here, like sending a welcome email,
    // assigning roles/permissions, etc.

    Toast::autoDismiss(7)->title('That\'s what\'s up')->success('User was successfully created!');

    return redirect()->back();
  }

  private function validateData(array $data)
  {
    return validator($data, [
      'name' => 'required|string|max:255',
      'email' => 'required|email|unique:users,email',
      'password' => 'required|string|min:6|confirmed',
    ])->validate();
  }
}
