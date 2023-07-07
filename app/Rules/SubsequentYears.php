<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Contracts\Validation\ValidationRule;

class SubsequentYears implements ValidationRule
{
  /**
   * Run the validation rule.
   *
   * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
   */
  public function validate(string $attribute, mixed $value, Closure $fail): void
  {
    $latestYear = \App\Models\SchoolYear::latest()->value('year');

    // Get the start year from the latest school year
    $startYear = intval(substr($latestYear, 0, 4));

    // Calculate the expected subsequent year
    $expectedYear = ($startYear + 1) . '-' . ($startYear + 2);

    // Check if the entered year matches the expected subsequent year
    if ($value !== $expectedYear) {
      $fail('The school year should be subsequent to the previous school year');
    }
  }
}
