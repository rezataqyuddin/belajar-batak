<?php

use Illuminate\Support\Facades\Route;
use App\Models\BatakChars;

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

Route::get('/learn', function () {
    $data = BatakChars::get();

    if (isset($_GET['huruf'])) {
        $huruf = $_GET['huruf'];
        $data = BatakChars::where("class", "=", $huruf)->get();
    }

    return view('intro', compact('data'));
})->name('learn');

Route::get('/statistik', function () {
    return view('stats');
})->name('stats');
