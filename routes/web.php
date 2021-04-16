<?php

use App\Models\Student;
use Illuminate\Support\Facades\DB;
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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/test', function () {
    $students = Student::where('gender','=','ذكر')->get();
    foreach ($students as $student)
        $student->update(['gender' => 'male']);
    dd($students);
});


