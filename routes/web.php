<?php

use App\Http\Controllers\BatakCharsController;
use App\Models\BatakChars;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/learning', function () {
    return view('learns');
})->name('introduction');

Route::get('/quiz', function () {
    return view('quiz');
})->name('quiz');

Route::get('/learn', [BatakCharsController::class, "index"])->name('learn');
Route::post('/predict', [BatakCharsController::class, "store"])->name('predict');

Route::get('/statistik', function () {
    return view('stats');
})->name('stats');
