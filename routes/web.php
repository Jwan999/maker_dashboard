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

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/api/current', [\App\Http\Controllers\TrainingController::class, 'show']);
Route::get('/api/products', [\App\Http\Controllers\ProductController::class, 'show']);
Route::get('/api/trainers', [\App\Http\Controllers\TrainerController::class, 'show']);

Route::get('/api/projects', [\App\Http\Controllers\ProjectController::class, 'show']);

Route::get('/api/startups', [\App\Http\Controllers\StartupController::class, 'show']);
Route::get('/api/numbers', [\App\Http\Controllers\StartupController::class, 'getModelsNumbers']);


