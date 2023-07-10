<?php

namespace App\Actions\Guardians;

use App\Models\User;

class AllGuardians
{
  public function __invoke()
  {
    // $guardians = User::where('type', 'guardian')->with('phones')
    //   ->get(['first_name', 'last_name', 'email', 'id']);

    $guardians = User::where('type', 'guardian')
      ->get()
      ->transform(function ($guardian) {
        return ['id' => $guardian->id, 'name' => $guardian->first_name . ' ' . $guardian->last_name];
      });

    return response()->json($guardians);
  }
}
