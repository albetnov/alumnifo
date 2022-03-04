<?php

use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Home;
use App\Http\Livewire\Login;
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

// Route::view('/login', 'authexample.login')->name('login');
Route::get('/login', Login::class)->name('login');

Route::view('/register', 'authexample.register')->name('register');

Route::get('/send_cs', function () {
    return "again an example";
})->name('send_cs');

Route::get('/', Home::class)->name('home');
Route::get('/dashboard', Dashboard::class)->name('dashboard');
