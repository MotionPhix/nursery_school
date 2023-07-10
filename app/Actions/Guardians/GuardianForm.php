<?php

namespace App\Actions\Guardians;

use App\Models\User;

class GuardianForm
{
  public function __invoke()
  {
    return view('guardians.create', [
      'guardian' => new User(),
    ]);
  }
}
