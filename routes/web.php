<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('splade')->group(function () {
  // Registers routes to support the interactive components...
  Route::spladeWithVueBridge();

  // Registers routes to support password confirmation in Form and Link components...
  Route::spladePasswordConfirmation();

  // Registers routes to support Table Bulk Actions and Exports...
  Route::spladeTable();

  // Registers routes to support async File Uploads with Filepond...
  Route::spladeUploads();

  Route::middleware('auth')->group(function () {

    Route::get('/', \App\Actions\Grades\AllGrades::class)->name('grades.index');
    Route::get('/create', \App\Actions\Grades\GradeForm::class)->name('grades.create');
    Route::post('/store', \App\Actions\Grades\StoreGrade::class)->name('grades.store');
    Route::get('/show/{grade}', \App\Actions\Grades\ShowGrade::class)->name('grades.show');

    Route::get('/students', \App\Actions\Students\AllStudents::class)->name('students.index');
    Route::get('/students/{grade}/create', \App\Actions\Students\StudentForm::class)->name('students.create');
    Route::post('/students/{grade}', \App\Actions\Students\StoreStudent::class)->name('students.store');

    Route::get('school-years', \App\Actions\SchoolYears\AllSchoolYears::class)->name('schoolyears.index');
    Route::get('school-years/create', \App\Actions\SchoolYears\SchoolYearForm::class)->name('schoolyears.create');
    Route::post('school-years', \App\Actions\SchoolYears\StoreSchoolYear::class)->name('schoolyears.store');

    Route::get('new-user', \App\Actions\UserForm::class)->name('users.create');
    Route::post('create-user', \App\Actions\CreateUser::class)->name('users.store');

    Route::get('/dashboard', function () {
      return view('dashboard');
    })->middleware(['verified'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
  });

  require __DIR__ . '/auth.php';
});
