<?php

namespace App\Actions;

use App\Models\User;

class UserForm
{
  public function __invoke()
  {
    return view('user.create', [
      'user' => new User()
    ]);
  }
}
