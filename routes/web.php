<?php

use App\Http\Controllers\DashboardController;
use App\Http\Livewire\{Dashboard, Home, Login, ProfileManager, Register};
use App\Http\Livewire\Tables\Kerja\{AddKerja, EditKerja, IndexKerja};
use App\Http\Livewire\Tables\Kuliah\{AddKuliah, EditKuliah, IndexKuliah};
use App\Http\Livewire\Tables\KerjaKuliah\{AddKerjaKuliah, EditKerjaKuliah, IndexKerjaKuliah};
use App\Http\Livewire\Tables\Usaha\{AddUsaha, EditUsaha, IndexUsaha};
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

    Route::group(['middleware' => ['role:SuperAdmin'], 'as' => 'admin.', 'prefix' => 'admin'], function () {
        Route::get('dashboard', Dashboard::class)->name('dashboard');
    });

    Route::group(['middleware' => ['role_or_permission:SuperAdmin|edit profile']], function () {
        Route::get('/profile', ProfileManager::class)->name('profile');
    });

    Route::group(['as' => 'table.', 'prefix' => 'table'], function () {
        Route::get('kerja', IndexKerja::class)->middleware('role_or_permission:SuperAdmin|viewKerja')->name('kerja.index');
        Route::get('kerja/add', AddKerja::class)->middleware('role_or_permission:SuperAdmin|addKerja')->name('kerja.add');
        Route::get('kerja/edit/{kerja}', EditKerja::class)->middleware('role_or_permission:SuperAdmin|editKerja')->name('kerja.edit');

        Route::get('kuliah', IndexKuliah::class)->middleware('role_or_permission:SuperAdmin|viewKuliah')->name('kuliah.index');
        Route::get('kuliah/add', AddKuliah::class)->middleware('role_or_permission:SuperAdmin|addKuliah')->name('kuliah.add');
        Route::get('kuliah/edit/{kuliah}', EditKuliah::class)->middleware('role_or_permission:SuperAdmin|editKuliah')->name('kuliah.edit');
        
        Route::get('kerja-kuliah', IndexKerjaKuliah::class)->middleware('role_or_permission:SuperAdmin|viewKuliah')->name('kerja-kuliah.index');
        Route::get('kerja-kuliah/add', AddKerjaKuliah::class)->middleware('role_or_permission:SuperAdmin|addKuliah')->name('kerja-kuliah.add');
        Route::get('kerja-kuliah/edit/{kerjaKuliah}', EditKerjaKuliah::class)->middleware('role_or_permission:SuperAdmin|editKuliah')->name('kerja-kuliah.edit');
    
        Route::get('usaha', IndexUsaha::class)->middleware('role_or_permission:SuperAdmin|viewKuliah')->name('usaha.index');
        Route::get('usaha/add', AddUsaha::class)->middleware('role_or_permission:SuperAdmin|addKuliah')->name('usaha.add');
        Route::get('usaha/edit/{usaha}', EditUsaha::class)->middleware('role_or_permission:SuperAdmin|editKuliah')->name('usaha.edit');
    });
    // Route::group(['middleware' => ['role:user']], function() {
    // Route::get('/home', HomeUser::class)->name('home.user');
    // });
});
