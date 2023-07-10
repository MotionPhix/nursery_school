<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
  use HasFactory;

  protected $appends = ['age', 'born_on'];

  public function getAgeAttribute()
  {
    $birthday = Carbon::parse($this->birthday);
    $currentDate = Carbon::now();
    $age = $currentDate->diffInYears($birthday);

    return $age;
  }

  public function getBornOnAttribute()
  {
    // return date('j M, Y', strtotime($this->birthday));
    return Carbon::parse($this->birthday)->format('j M, Y');
  }

  public function guardian()
  {
    return $this->belongsTo(User::class, 'user_id')
      ->where('type', 'guardian');
  }

  public function grade()
  {
    return $this->belongsTo(Grade::class);
  }

  public function grades()
  {
    return $this->belongsToMany(Grade::class, 'grade_student_school_year')
      ->withPivot('enrollment_date', 'school_year')
      ->withTimestamps();
  }

  public function enrollmentHistory()
  {
    return $this->hasMany(Grade::class, 'grade_student_school_year')
      ->withPivot('enrollment_date', 'school_year')
      ->withTimestamps();
  }
}
