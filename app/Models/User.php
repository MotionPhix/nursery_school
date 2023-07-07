<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
  use HasApiTokens, HasFactory, Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'first_name',
    'last_name',
    'email',
    'password',
    'type'
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
    'password' => 'hashed',
  ];

  /**
   * Get the formatted created_at attribute.
   *
   * @param  string  $value
   * @return string
   */
  public function getCreatedAtAttribute($value)
  {
    return date('j F, y', strtotime($value));
  }

  public function phones()
  {
    return $this->morphMany(Phone::class, 'phoneable');
  }

  public function children() {
    return $this->hasMany(Student::class, 'user_id');
  }

  protected static function boot()
  {
    parent::boot();

    static::created(function ($user) {
      // Check if the user is the first in the database
      $isFirstUser = static::count() === 1;

      if ($isFirstUser) {
        // Set the user's type to "administrator"
        $user->type = 'administrator';
        $user->save();
      }
    });
  }
}
