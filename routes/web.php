<?php

use App\Http\Controllers\DashboardController;
use App\Http\Livewire\Home;
use App\Http\Livewire\Login;
use App\Http\Livewire\ProfileManager;
use App\Http\Livewire\Register;
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

Route::get('/login', Login::class)->name('login')->middleware('guest');
Route::get('/register', Register::class)->name('register')->middleware('guest');

Route::get('/send_cs', function () {
    return "again an example";
})->name('send_cs');

Route::get('/', Home::class)->name('home');
Route::group(['middleware' => ['auth']], function () {
    Route::post('logout', [DashboardController::class, 'logout'])->name('logout');

    Route::group(['middleware' => ['role_or_permission:SuperAdmin|edit profile']], function () {
        Route::get('/profile', ProfileManager::class)->name('profile');
    });

    require_once __DIR__ . '/admin.php';

    require_once __DIR__ . '/table.php';

    require_once __DIR__ . '/user.php';

    Route::group(['middleware' => ['role:disabled']], function () {
        Route::view('/disabled/dashboard', 'disabled')->name('disabled.dashboard');
    });
});
