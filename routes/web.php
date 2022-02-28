<?php

use App\Models\Teams;
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

Route::get('/login', function () {
    return "example";
})->name('login');

Route::get('/register', function () {
    return "another example";
})->name('register');

Route::get('/send_cs', function () {
    return "again an example";
})->name('send_cs');

Route::get('/', function () {
    $teams = Teams::get();
    return view('index', compact('teams'));
});
